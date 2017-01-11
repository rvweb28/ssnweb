<?php

namespace App\Controllers;

class StaticController extends Controller
{
  public function index($request, $response)
  {
    return $this->view->render($response, 'home.twig');
  }

  public function contact($request, $response)
  {
    return $this->view->render($response, 'contact.twig');
  }

  public function legal($request, $response)
  {
    return $this->view->render($response, 'sonstiges/legal.twig');
  }

  public function privacy($request, $response)
  {
    return $this->view->render($response, 'sonstiges/privacy.twig');
  }



  # INFORMATIONEN
  public function jobangebote($request, $response)
  {
    return $this->view->render($response, 'info/jobangebote.twig');
  }
  public function leistungsangebot($request, $response)
  {
    return $this->view->render($response, 'info/leistungsangebot.twig');
  }
  public function mitarbeiter($request, $response)
  {
    return $this->view->render($response, 'info/mitarbeiter.twig');
  }
  public function kostenubersicht($request, $response)
  {
    return $this->view->render($response, 'info/kostenubersicht.twig');
  }
  public function pflegegesetz($request, $response)
  {
    return $this->view->render($response, 'info/pflegegesetz.twig');
  }

  /*
  public function jobEdit($request, $response)
  {
    return $this->view->render($response, 'sonstiges/jobEdit.twig', StaticController::getJobs());
  }
  public function jobCommitEdit($request, $response)
  {
    $jobs = filter_var($request->getParam('jobs'), FILTER_SANITIZE_STRING);

    StaticController::setJobs($jobs);

    return 'ok';
  }

  public function jobLogin($request, $response)
  {
    $user = $request->getParam('user');
    $password = $request->getParam('password');

    if(($user === 'adriana_reichenbach' && $password === 'seniorenserviceneustadt123') || $_SESSION['is_logged_in']) {

      $jobs = StaticController::getJobs()['jobs'];
      $_SESSION['is_logged_in'] = true;
      $data = [
        'logged_in' => true,
        'jobs' => $jobs,
        'jobsAsJson' => json_encode(StaticController::setKeys($jobs)),
      ];
      return $this->view->render($response, 'sonstiges/jobEdit.twig', $data);

    } else {

      return $this->view->render($response, 'sonstiges/jobEdit.twig', ['login_error' => true]);
    }
  }

  public static $job_path = __DIR__ . '/../../resources/data/jobangebote.data';
  public static function getJobs()
  {
    # one job per line
    return ['jobs' => file(StaticController::$job_path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES)];
  }
  public static function setJobs($jobs) # jobs is a string, jobs are seperated by \n
  {
    if($_SESSION['is_logged_in']) {

      $file = fopen(StaticController::$job_path, 'w');

      fwrite($file, $jobs);

      fclose($file);
    }
    $_SESSION['is_logged_in'] = false;
  }
  public static function setKeys($jobs)
  {
    $temp = [];
    $key = 0;

    foreach($jobs as $job) {

      $temp['id-' . $key] = $job;
      $key++;
    }
    return $temp;
  }*/
}
