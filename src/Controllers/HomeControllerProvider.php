<?php

namespace App\Controllers;

use Silex\Application;
use Silex\Api\ControllerProviderInterface;


class HomeControllerProvider implements ControllerProviderInterface
{
    public function connect(Application $app)
    {
        $home = $app['controllers_factory'];

        $home
            ->get('/', function (Application $app) {
                return $app['twig']->render('index.html.twig', array());
            })
            ->bind('home');

        return $home;
    }
}
