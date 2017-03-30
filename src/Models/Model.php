<?php

namespace App\Models;

use Silex\Application;

/**
 * Class Model
 * base class responsible for create database and share queryBuilder instance.
 *
 * @package App\Models
 */
class Model
{
    protected $connection;
    protected $queryBuilder;

    /**
     * Model constructor.
     * Get application instance, create basic schema and
     * create queryBuilder instance for using in CRUD.
     *
     * @param Application $app
     */
    public function __construct(Application $app)
    {
        $this->connection = $app['db'];
        $this->createCommentsTableIfNotExists();
        $this->queryBuilder = $app['db']->createQueryBuilder();
    }

    /**
     * Creates necessary tables
     * Likes and Comments split in two tables for easy check for user ip before save like.
     *
     * @return mixed
     */
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