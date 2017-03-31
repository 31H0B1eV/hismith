<?php

namespace App\Models;

use Silex\Application;

/**
 * Likes model
 * For now all methods must be self documented
 *
 * @package App\Models
 */
class Likes extends Model
{

    public function __construct(Application $app)
    {
        parent::__construct($app);
    }

    public function checkIfAlreadyLiked($userIp, $commentId)
    {
        $sql = "SELECT id FROM likes
                WHERE user_ip = {$userIp} AND comment_id = {$commentId}";

        return $this->connection->query($sql)->fetchAll();
    }

}
