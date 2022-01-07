<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DBController extends Controller
{
    public static function loadDB($default = null, ?\Closure $callback = null)
    {
        return static::load($default, $callback);
    }

    public static function load($default = null, ?\Closure $callback = null, string $db = 'db')
    {
        try {
            $result = static::get($db);
        } catch( \Exception $exception ) {
            $result = null;
        }
        if( $result ) {
            $get_result = function ($result) {
                return $result && file_exists(
                    $result_path = database_path($result)
                ) ? $result_path : false;
            };
            $result_sqlite =
                str_contains($result, '.sqlite')
                    ? str_ireplace(".sqlite", "", $result)
                    : "{$result}.sqlite";
            $result = $get_result($result_sqlite) ?: $get_result($result);
        }
        $callback = $callback instanceof \Closure ? $callback : fn($a) => $a;
        return $callback($result ?: $default);
    }

    public static function get(?string $key = null, $default = null, ?\Closure $callback = null)
    {
        try {
            $result = json_decode(file_get_contents(database_path('config.json')), true);
        } catch( \Exception $exception ) {
            $result = [];
        }
        $result = $key ? data_get((array) $result, $key) : (array) $result;
        $callback = $callback instanceof \Closure ? $callback : fn($a) => $a;
        return $callback($result ?: $default);
    }

    public static function loadWA($default = null, ?\Closure $callback = null)
    {
        return static::load($default, $callback, 'wa');
    }

    public function index(Request $request)
    {
        return view('db.index', [
            'list'       => collect(glob(database_path('*.sqlite')))
                ->map(fn($n) => Str::before(basename($n), '.sqlite'))
                ->map(fn($n) => [
                    'name' => $n,
                    'id'   => "{$n}.sqlite",
                ])
            ,
            'show_media' => $request->view == 'media',
        ]);
    }

    public function show(Request $request, string $db)
    {
        if( !$db ) {
            return "enter name";
        }

        $db = str_contains($db, '.sqlite') ? Str::before($db, '`.sqlite`') : $db;
        static::save(compact('db'));

        return redirect()->to(route('msgs.index'));
    }

    public static function save($data = []): bool
    {
        $data = array_merge(static::get(), (array) $data);
        return file_put_contents(
            database_path('config.json'),
            json_encode($data, JSON_PRETTY_PRINT)
        );
    }
}
