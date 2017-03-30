<?php

namespace App\Models;

use Silex\Application;

class Comments extends Model
{

    public function __construct(Application $app)
    {
        parent::__construct($app);
    }

    public function callSelectForNameWithEmail()
    {
        $records = $this->queryBuilder->select('name', 'email')
            ->from('users');
        return $records->execute();
    }
}
