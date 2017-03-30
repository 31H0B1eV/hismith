<?php

namespace App\Models;

use Silex\Application;

class Comments extends Model
{

    public function __construct(Application $app)
    {
        parent::__construct($app);
    }

    public function getAllComments()
    {
        $sql = "SELECT c.author_name, c.feedback_text AS feedback, INET_NTOA(c.author_ip) AS ip,
                    c.published_at, l.comment_id AS comment_liked, INET_NTOA(l.user_ip) AS user_ip,
                    (SELECT COUNT(l2.comment_id) FROM likes l2 WHERE l.comment_id = c.id) AS likes
                FROM comments as c
                INNER JOIN likes AS l ON c.id = l.comment_id";

        return $this->connection->query($sql);
    }
}
