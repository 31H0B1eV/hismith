<?php

namespace App\Models;

use Silex\Application;

/**
 * Comments model
 * For now all methods must be self documented
 *
 * @package App\Models
 */
class Comments extends Model
{

    public function __construct(Application $app)
    {
        parent::__construct($app);
    }

    public function getAllComments()
    {
        $sorting = $_GET['sort'] == 'ASC' ? 'ASC' : 'DESC';
        $order = $_GET['order'] == 'likes' ? 'likes' : 'c.published_at';

        $sql = "SELECT c.id, c.author_name AS author, c.feedback_text AS feedback, c.published_at,                    
                    (SELECT COUNT(l2.id) FROM likes l2 WHERE l2.comment_id = c.id) AS likes                    
                FROM comments as c ORDER BY {$order} {$sorting}";

        return $this->connection->query($sql)->fetchAll();
    }

    public function getComment($id)
    {
        $id = (int) $id;

        $sql = "SELECT c.id, c.author_name AS author, c.feedback_text AS feedback, c.published_at,
                    INET_NTOA(c.author_ip) AS author_ip,
                    (SELECT COUNT(l2.id) FROM likes l2 WHERE l2.comment_id = c.id) AS likes                    
                FROM comments as c WHERE c.id = {$id}";

        return $this->connection->query($sql)->fetchAll();
    }

}
