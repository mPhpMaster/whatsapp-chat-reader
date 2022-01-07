<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\WaModel;

class Wa extends WaModel
{
    use HasFactory;

    protected $connection = 'wa-sqlite';
    protected $guarded = [];
    protected $table = 'wa_contacts';
    protected $primaryKey = 'jid';

    public static function isConnected(): bool
    {
        try {
            static::first();
        } catch( \Illuminate\Database\QueryException $exception ) {
            return false;
        }

        return true;
    }

    public function scopeByJId(Builder $query, $jid)
    {
        return $this->where('jid', $jid);
    }

    public function getName()
    {
        return ((trim($this->display_name) ?: trim($this->number)) ?: trim($this->jid)) ?: "-";
    }
}
