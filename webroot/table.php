<?php

require __DIR__.'/config_with_app.php';

//To get clean url. Notice it must be before navbar to work as expected
 

// Create services and inject into the app.
$di  = new \Anax\DI\CDIFactoryDefault();
 
$app = new \Anax\Kernel\CAnax($di);
$app->theme->configure(ANAX_APP_PATH . 'config/theme.php');

$di->set('ctable', function() use ($di) {
    $table = new \Edtau\Table\CTable();
    $table>setDI($di);
    return $table;
});

$di->set('TableController', function() use ($di) {
    $controller = new \Edtau\Table\TableController();
    $controller->setDI($di);
    return $controller;
});
// test route for table
$app->router->add('', function() use ($app) {
    $app->theme->setTitle("Tabletest");

    $app->dispatcher->forward([
        'controller' => 'Table',
        'action'     => 'test',
    ]);
});
//route to show how to use table
$app->router->add('table', function() use ($app) {

    $app->theme->setTitle("table");

    $header = array('Förnamn', 'Efternamn', 'ålder');
    $data = array(
        array('Anders', 'Andersson', '40'),
        array('Stig', 'Larsson', '41'),
        array('Anna', 'Svensson', '45'),
        array('Bengt', 'Andersson', '40'),
        array('Karin', 'Larsson', '41'),
        array('Ulf', 'Svensson', '45')
    );
    $id = "red";

    $app->dispatcher->forward([
        'controller' => 'Table',
        'action'     => 'getTable',
        'param' => $data,
        'param' => $header,
        'params'     => [$data,$header,$id],

    ]);
});

//Router Source
$app->router->add('source', function() use ($app) {

    $app->theme->addStylesheet('css/source.css');
    $app->theme->setTitle("K�llkod");

    $source = new \Mos\Source\CSource([
        'secure_dir' => '..',
        'base_dir' => '..',
        'add_ignore' => ['.htaccess'],
    ]);

    $app->views->add('default/source', [
        'content' => $source->View(),
    ]);

});
 
 
 
$app->router->handle();
$app->theme->render();
