<?php

namespace App\Models;

use Silex\Application;
use Faker\Factory;

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
        $this->createTablesIfNotExists();
        $this->queryBuilder = $app['db']->createQueryBuilder();
    }

    /**
     * Creates necessary tables
     * Likes and Comments split in two tables for easy check for user ip before save like.
     *
     * @return mixed
     */
    private function createTablesIfNotExists()
    {
        $sql = "CREATE TABLE IF NOT EXISTS `likes` (
                    `id` INT NOT NULL AUTO_INCREMENT,
                    `comment_id` INT,
                    `user_ip` INT UNSIGNED,
                    PRIMARY KEY (`id`)
                ) ENGINE=INNODB CHARACTER SET 'utf8' COLLATE 'utf8_general_ci';

                CREATE TABLE IF NOT EXISTS `comments` (
                    `id` INT NOT NULL AUTO_INCREMENT,
                    `author_name` VARCHAR(64) NOT NULL,
                    `author_ip` INT UNSIGNED NOT NULL,
                    `feedback_text` TEXT NOT NULL,
                    `published_at` DATETIME NOT NULL,
                    PRIMARY KEY (`id`)
                ) ENGINE=INNODB CHARACTER SET 'utf8' COLLATE 'utf8_general_ci'";

        return $this->connection->query($sql);
    }

    /**
     * As there is no default or easy way for database migrations this
     * method is simplify development process
     * used for create single fake record in database.
     *
     * Call it by $this->generateFakeRecord(); as needed.
     */
    public function generateFakeRecord()
    {
        $faker = Factory::create();
        $qbComments = $this->connection->createQueryBuilder();
        $qbLikes = $this->connection->createQueryBuilder();

        $qbComments
            ->insert('comments')
            ->values(
                array(
                    'author_name' => '?',
                    'author_ip' => '?',
                    'feedback_text' => '?',
                    'published_at' => '?',
                )
            )
            ->setParameter(0, $faker->name)
            ->setParameter(1, ip2long($faker->ipv4))
            ->setParameter(2, $faker->realText($maxNbChars = 200, $indexSize = 2))
            ->setParameter(3, $faker->dateTime->format('Y-m-d H:i:s'))
            ->execute();

        $qbLikes
            ->insert('likes')
            ->values(
                array(
                    'comment_id' => '?',
                    'user_ip' => '?',
                )
            )
            ->setParameter(0, rand(1, 10))
            ->setParameter(1, ip2long($faker->unique()->ipv4))
            ->execute();
    }
}