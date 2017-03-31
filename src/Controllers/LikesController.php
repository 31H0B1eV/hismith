<?php

namespace App\Controllers;

use App\Models\Comments;
use Silex\Application;
use App\Models\Likes;

class LikesController
{
    /**
     * Handle checking and add like
     * TODO: will be better move all database work in Models...
     *
     * @param Application $app
     * @param $id
     * @return mixed
     */
    public function addAction(Application $app, $id)
    {
        $user_ip = ip2long($_SERVER['REMOTE_ADDR']);

        $likes = new Likes($app);

        $exists = $likes->checkIfAlreadyLiked($user_ip, $id);

        if(sizeof($exists) != 0) {
            return 'exists';
        } else {
            $app['db']->createQueryBuilder()
                ->insert('likes')
                ->values(array(
                    'comment_id' => '?',
                    'user_ip' => '?',
                ))
                ->setParameter(0, $id)
                ->setParameter(1, $user_ip)
                ->execute();

            $comment = new Comments($app);
            $likes = $comment->getComment($id);

            return $likes[0]['likes'];
        }
    }
}