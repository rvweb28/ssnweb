<?php

$app->get('/', 'HomeController:index')->setName('index');
$app->get('/impressum', 'HomeController:legal')->setName('legal');
$app->get('/kontakt', 'HomeController:contact')->setName('contact');
$app->get('/datenschutz', 'HomeController:privacy')->setName('privacy');

$app->get('/gutscheine', 'HomeController:gutscheine')->setName('gutscheine');
$app->get('/jobangebote', 'HomeController:jobangebote')->setName('jobangebote');

$app->get('/leistungsangebot', 'HomeController:leistungsangebot')->setName('leistungsangebot');
$app->get('/mitarbeiter', 'HomeController:mitarbeiter')->setName('mitarbeiter');
$app->get('/kostenuebersicht', 'HomeController:kostenubersicht')->setName('kostenubersicht');
$app->get('/pflegestaerkungsgesetz', 'HomeController:pflegegesetz')->setName('pflegegesetz');

$app->get('/jobangebote/bearbeiten', 'HomeController:jobEdit')->setName('jobangeboteBearbeiten');
$app->post('/jobangebote/bearbeiten/login', 'HomeController:jobLogin')->setName('jobLogin');
$app->post('/jobangebote/bearbeiten', 'HomeController:jobCommitEdit');

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
