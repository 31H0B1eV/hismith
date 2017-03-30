<?php

namespace App\Controllers;

use Silex\Application;

class HomeController
{
    public function indexAction(Application $app)
    {
        // $sql = "SELECT name, email FROM users";
        // $records= $app['db']->fetchAll($sql);
        $builder= $app['db']->createQueryBuilder();
        $builder->select('name', 'email')
            ->from('users');
        $records = $builder->execute();

        return $app['twig']->render('index.html.twig', array(
            'records' => $records,
        ));
    }
}