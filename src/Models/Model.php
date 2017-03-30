<?php

namespace App\Models;

use Silex\Application;

class Model
{
    protected $connection;
    protected $queryBuilder;

    public function __construct(Application $app)
    {
        $this->connection = $app['db'];
        $this->createCommentsTableIfNotExists();
        $this->queryBuilder = $app['db']->createQueryBuilder();
    }

    private function createCommentsTableIfNotExists()
    {
        $sql = "CREATE TABLE IF NOT EXISTS `likes` (
                    `id` INT NOT NULL AUTO_INCREMENT,
                    `comment_id` INT,
                    `user_ip` INT,
                    PRIMARY KEY (`id`)
                ) ENGINE=INNODB CHARACTER SET 'utf8' COLLATE 'utf8_general_ci';
        
                CREATE TABLE IF NOT EXISTS `comments` (
                    `id` INT NOT NULL AUTO_INCREMENT,
                    `author_name` VARCHAR(64) NOT NULL,
                    `author_ip` INT NOT NULL,
                    `feedback_text` TEXT NOT NULL,
                    `pub_date` DATETIME NOT NULL,
                    PRIMARY KEY (`id`),
                    UNIQUE KEY `author_ip` (`author_ip`)
                ) ENGINE=INNODB CHARACTER SET 'utf8' COLLATE 'utf8_general_ci'";

        return $this->connection->query($sql);
    }
}