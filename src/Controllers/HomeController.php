<?php

namespace App\Controllers;

use Silex\Application;

class HomeController
{
    public function indexAction(Application $app)
    {
        $sql = "SELECT name, email FROM users";
        $records= $app['db']->fetchAll($sql);

        return $app['twig']->render('index.html.twig', array(
            'records' => $records,
        ));
    }
}