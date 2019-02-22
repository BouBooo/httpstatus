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
        	'history' => '/api/history/{id}',
        	'insert' => '/api/add',
        	'delete' => '/api/delete/{id}',
        	'check_status' => '/api/sites'
        ]
    );

    define('ROUTES', $routes);
