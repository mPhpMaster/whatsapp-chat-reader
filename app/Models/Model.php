<?php

namespace App\Models;

class Model extends \Illuminate\Database\Eloquent\Model
{
    public static $user_connection_name = null;

    protected function bootIfNotBooted()
    {
        $this->connection = static::$user_connection_name ?? $this->connection;
        parent::bootIfNotBooted();
    }
}
