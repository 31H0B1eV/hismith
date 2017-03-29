<?php

namespace App\Controllers;

use Silex\Application;

class HomeController
{
    public function indexAction(Application $app)
    {
        return $app['twig']->render('index.html.twig', array());
    }
}