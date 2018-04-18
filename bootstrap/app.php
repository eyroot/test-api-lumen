<?php

require_once __DIR__.'/../vendor/autoload.php';

$app = new Laravel\Lumen\Application(
	realpath(__DIR__.'/../')
);

$app->singleton('StorageDvds', function ($app) {
	return Lx\Storage\Factory::create(
		Lx\Storage\Factory::TYPE_JSON,
		'dvds',
		[
			'path' => __DIR__ . '/../data',
			'id' => 'dvdId'
		]
	);
});

$app->router->group([
	'namespace' => 'App\Http\Controllers',
], function ($router) {
	require __DIR__.'/../routes/web.php';
});

return $app;
