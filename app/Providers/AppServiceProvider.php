<?php

namespace App\Providers;

use App\Models\ChatList;
use App\Models\Model;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public static $user_connection_name = 'user-sqlite';

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        try {
            if( static::$user_connection_name ) {
                (new ChatList)->setConnection(static::$user_connection_name)->find('*');
            }
            Model::$user_connection_name = static::$user_connection_name;
        } catch( \Exception $exception ) {
            Model::$user_connection_name = null;
        }
    }
}
