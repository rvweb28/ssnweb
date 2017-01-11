<?php

namespace App\Controllers;

class Controller      # BaseController, just extend it when creating a new controller
{
  protected $container;
  protected $view;
  protected $router;

  public function __construct($container)
  {
    $this->container = $container;
    $this->view = $container->view;
    $this->router = $container->router;
  }
}
