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
        	'status' => '/api/status/{id}',
        	'insert' => '/api/add',
        	'delete' => '/api/delete/{id}',
        	'check' => '/api/check'
        ]
    );

    define('ROUTES', $routes);
