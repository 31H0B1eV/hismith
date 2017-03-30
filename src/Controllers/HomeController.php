<?php

namespace App\Controllers;

use Silex\Application;
use App\Models\Comments;

class HomeController
{
    public function indexAction(Application $app)
    {
        $builder = new Comments($app);
        $comments = $builder->getAllComments();

        return $app['twig']->render('index.html.twig', array(
            'comments' => $comments,
        ));
    }
}