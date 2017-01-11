<?php

session_start();

require __DIR__ . '/../vendor/autoload.php';

$app = new \Slim\App([
  'settings' => [
    'displayErrorDetails' => true,        # only for debugging, for production env set to false
  ]
]);

$container = $app->getContainer();


# setting up twig
$container['view'] = function($container) {

  $view = new \Slim\Views\Twig(__DIR__ . '/../resources/views', [
    'cache' => false,
  ]);

  $view->addExtension(new \Slim\Views\TwigExtension(
    $container->router,
    $container->request->getUri()
  ));

  return $view;
};

# 404 view
$container['notFoundHandler'] = function ($c) {
    return function ($request, $response) use ($c) {
      return $c['view']->render($response, 'errors/404.twig', []);
    };
};

# add new controllers here
$container['StaticController'] = function($container) { return new \App\Controllers\StaticController($container); };
$container['AuthController'] = function($container) { return new \App\Controllers\AuthController($container); };

require __DIR__ . '/../app/routes.php';
