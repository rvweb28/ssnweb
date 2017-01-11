<?php

namespace App\Controllers;

class AuthController extends Controller {

  public static $editable_views = [
    'home', 'jobangebote', 'leistungsangebot', 'mitarbeiter', 'kostenuebersicht', 'pflegestaerkungsgesetz'
  ];

  public function editHome($request, $response)
  {
    return $this->bearbeiten($request, $response, ['page' => 'home']);
  }
  public function bearbeiten($request, $response, $args)
  {
    $requested_uri = $args['page'];
    $saved = $request->getParam('saved');

    if($_SESSION['logged_in']) {

      $path = __DIR__ . '/../../resources/views/data/' . $requested_uri . '.html';
      $file = fopen($path, 'r');

      $page_content = fread($file, filesize($path));

      fclose($file);

      $this->view->render($response, 'sonstiges/bearbeiten.twig', [ 'page_content' => $page_content, 'requested_uri' => $requested_uri, 'saved' => $saved ]);

    } else if (in_array($requested_uri, AuthController::$editable_views)) {

      AuthController::showLogin($request, $response, $args);

    } else {

      return $this->view->render($response, 'errors/not_editable.twig');
    }
  }

  public function showLogin($request, $response, $args)
  {
    $requested_uri = $args['page'];

    return $this->view->render($response, 'auth/login.twig', ['requested_uri' => $requested_uri]);
  }

  public function processLogin($request, $response)
  {
    $user = $request->getParam('user');
    $password = $request->getParam('password');
    $requested_uri = $request->getParam('requested_uri');

    if(($user === 'adriana_reichenbach' && $password === 'seniorenserviceneustadt123') || $_SESSION['logged_in']) {

      $_SESSION['logged_in'] = true;

      return $response->withRedirect($this->container->router->pathFor('bearbeiten', ['page' => $requested_uri]));

    } else {

      return $this->view->render($response, 'auth/login.twig', ['login_error' => true]);
    }
  }
  public function logout($request, $response)
  {
    $_SESSION['logged_in'] = false;

    if($request->getParam('uri') != '') {

      return $response->withRedirect($request->getParam('uri'));

    } else {

      return $response->withRedirect($this->container->router->pathFor('index'));
    }
  }

  public function commitEdit($request, $response)
  {
    $edited_content = $request->getParam('page-edit');
    $requested_uri = $request->getParam('requested_uri');

    $path = __DIR__ . '/../../resources/views/data/' . $requested_uri . '.html';
    $file = fopen($path, 'w');

    fwrite($file, $edited_content);

    fclose($file);

    return $response->withRedirect($this->container->router->pathFor('bearbeiten', ['page' => $requested_uri]) . '?saved=true');
  }
}
