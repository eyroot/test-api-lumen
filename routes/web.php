<?php

$router->get('/', function () use ($router) {
	return 'welcome to your dedicated online dvds api';
});

$router->post('dvds', ['uses' => 'DvdsController@add']); // insert
$router->put('dvds/{id:[0-9]+}', ['uses' => 'DvdsController@update']); // update
$router->delete('dvds/{id:[0-9]+}', ['uses' => 'DvdsController@delete']); // delete
$router->get('dvds', ['uses' => 'DvdsController@listAll']); // list all
$router->get('dvds/{field:[a-zA-Z0-9]+}/{value}', ['uses' => 'DvdsController@searchByField']); // search by field
