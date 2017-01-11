<?php

$app->get('/', 'StaticController:index')->setName('index');
$app->get('/home', 'StaticController:index')->setName('home');
$app->get('/impressum', 'StaticController:legal')->setName('legal');
$app->get('/kontakt', 'StaticController:contact')->setName('contact');
$app->get('/datenschutz', 'StaticController:privacy')->setName('privacy');

$app->get('/jobangebote', 'StaticController:jobangebote')->setName('jobangebote');
$app->get('/leistungsangebot', 'StaticController:leistungsangebot')->setName('leistungsangebot');
$app->get('/mitarbeiter', 'StaticController:mitarbeiter')->setName('mitarbeiter');
$app->get('/kostenuebersicht', 'StaticController:kostenubersicht')->setName('kostenubersicht');
$app->get('/pflegestaerkungsgesetz', 'StaticController:pflegegesetz')->setName('pflegegesetz');

$app->get('/{page}/bearbeiten', 'AuthController:bearbeiten')->setName('bearbeiten');
$app->get('/bearbeiten', 'AuthController:editHome')->setName('editHome');
$app->post('/login', 'AuthController:processLogin')->setName('processLogin');
$app->get('/logout', 'AuthController:logout')->setName('logout');
$app->post('/commit_edit', 'AuthController:commitEdit')->setName('commitEdit');

$app->post('/send_mail', function($request, $response) {

  $from = filter_var($request->getParam('email'), FILTER_SANITIZE_EMAIL);
  $name = filter_var($request->getParam('name'), FILTER_SANITIZE_STRING);
  $msg = filter_var($request->getParam('msg'), FILTER_SANITIZE_STRING);

  $to = 'info@senioren-service-neustadt.de';

  $msg = 'Von: ' . $name . ', ' . $from . '\r\n' . $msg;

  $header = 'From: '. $from . "\r\n" .
    'Reply-To: ' . $from . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

  mail($to, "Website-Kontaktanfrage von $name", $msg, $header);

  return 'ok';

})->setName('mail');
