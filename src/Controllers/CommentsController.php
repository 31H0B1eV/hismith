<?php

namespace App\Controllers;

use Silex\Application;
use App\Models\Comments;

class CommentsController
{

    public function indexAction(Application $app)
    {
        $builder = new Comments($app);
        $comments = $builder->getAllComments();

        return $app['twig']->render('index.html.twig', array(
            'comments' => $comments
        ));
    }

    public function commentAction(Application $app, $id)
    {
        $builder = new Comments($app);
        $comment = $builder->getComment($id);

        return $app['twig']->render('comment.html.twig', array(
            'comment' => $comment,
        ));
    }
}