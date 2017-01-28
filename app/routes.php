<?php

include __DIR__ . '/phpmailer/class.phpmailer.php';
include __DIR__ . '/phpmailer/class.smtp.php';

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

  $email = filter_var($request->getParam('email'), FILTER_SANITIZE_EMAIL);
  $name = filter_var($request->getParam('name'), FILTER_SANITIZE_STRING);
  $msg = filter_var($request->getParam('msg'), FILTER_SANITIZE_STRING);

  $to = 'info@senioren-service-neustadt.de';

  $msg = 'Von: ' . $name . ', ' . $from . '\r\n' . $msg;

  mail($to, "Website-Kontaktanfrage von $name", $msg, $header);

  $to = 'info@senioren-service-neustadt.de';
  $subject = "Website-Kontaktanfrage von $name";
  $message = $msg;
  $header = 'From: ' . $email . "\r\n" .
    'Reply-To: ' . $email . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

  $mail = new PHPMailer();

  $mail->IsSMTP();
  $mail->Host     = 'smtp.zoho.com';
  $mail->SMTPAuth = true;
  $mail->Username = 'info@senioren-service-neustadt.de';
  $mail->Password = 'Michael!';
  $mail->Port = 587;
  $mail->SMTPSecure = 'tls';

  $mail->Subject = $subject;
  $mail->Body     = $message;
  $mail->From     = $email;
  $mail->FromName = $email;
  $mail->AddReplyTo($email);
  $mail->CharSet  =  "utf-8";
  $mail->AddAddress($to);
  $mail->Send();

  return 'ok';

})->setName('mail');
