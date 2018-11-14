<?php

require('../vendor/autoload.php');

$app = new Silex\Application();
$app['debug'] = true;

// Register the monolog logging service
$app->register(new Silex\Provider\MonologServiceProvider(), array(
  'monolog.logfile' => 'php://stderr',
));

// Register view rendering
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/views',
));

// Our web handlers

$app->get('/', function() use($app) {
  $app['monolog']->addDebug('logging output.');
  return $app['twig']->render('index.twig');
});

$app->get('/Mediciones/{v1/v2/i1/i2/i3/p1/p2}', function($v1;$v2;$i1;$i2;$i3;$p1;$p2) use($app){
	$dbconexion=pg_connect("host=ec2-23-21-192-179.compute-1.amazonaws.com port=5432 dbname=d83082i66m502p user=auwnpcmayyfvrf password=9c4d61ed2d9d293b80902dbfe5611d7bde523f1ec69d9853b8e349df73b2161c");
	$registro=array(
		"fecha"=>date('Y-m-d H:i:s'),
		"voltaje_1"=>$v1);
		"voltaje_2"=>$v2);
	    "corriente_1"=>$i1);
        "corriente_2"=>$i2);
        "corriente_3"=>$i3);
        "potencia_1"=>$p1);
        "potencia_2"=>$p2);
	$resultado=pg_insert ($dbconexion,'Mediciones',$registro);
	return date('Y-m-d H:i:s');

	});

$app->get('/medicion_test/{v1}/{v2}/{i1}/{i2}/{i3}/{p1}/{p2}', function($v1,$v2,$i1,$i2,$i3,$p1,$p2) use($app){
	$dbconexion=pg_connect( "host=ec2-23-21-192-179.compute-1.amazonaws.com port=5432 dbname=d83082i66m502p user=auwnpcmayyfvrf password=9c4d61ed2d9d293b80902dbfe5611d7bde523f1ec69d9853b8e349df73b2161c");
	$registro=array(
		"fecha"=>date('Y-m-d H:i:s'),
		"voltaje_1"=>$v1,
		"voltaje_2"=>$v2,
	    "corriente_1"=>$i1,
        "corriente_2"=>$i2,
        "corriente_3"=>$i3,
        "potencia_1"=>$p1,
        "potencia_2"=>$p2);
	$resultado=pg_insert ($dbconexion,"medicion_test",$registro);
	return $resultado;

	});

$app->get('/testing/{v1}', function($v1) use($app){
	$dbconexion=pg_connect( "host=ec2-23-21-192-179.compute-1.amazonaws.com port=5432 dbname=d83082i66m502p user=auwnpcmayyfvrf password=9c4d61ed2d9d293b80902dbfe5611d7bde523f1ec69d9853b8e349df73b2161c");
	$registro=array(
		"fecha"=>date('Y-m-d H:i:s'),
		"voltaje_1"=>$v1);
	$resultado=pg_insert ($dbconexion,"medicion_test",$registro);
	return $resultado;

	});

$app->run();
