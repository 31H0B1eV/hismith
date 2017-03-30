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
        $sql = "SELECT c.id, c.author_name AS author, c.feedback_text AS feedback, c.published_at,                    
                    (SELECT COUNT(l2.id) FROM likes l2 WHERE l2.comment_id = c.id) AS likes                    
                FROM comments as c";

        return $this->connection->query($sql);
    }

    public function getComment($id)
    {
        $sql = "SELECT c.author_name AS author, c.feedback_text AS feedback, c.published_at,
                    INET_NTOA(c.author_ip) AS author_ip,
                    (SELECT COUNT(l2.id) FROM likes l2 WHERE l2.comment_id = c.id) AS likes                    
                FROM comments as c WHERE c.id = {$id}";

        return $this->connection->query($sql);
    }

}
