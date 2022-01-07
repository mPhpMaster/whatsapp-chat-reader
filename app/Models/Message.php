<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Message extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $fillable = [
        "_id",
        "key_remote_jid",
        "key_from_me",
        "key_id",
        "status",
        "needs_push",
        "data",
        "timestamp",
        "media_url",
        "media_mime_type",
        "media_wa_type",
        "media_size",
        "media_name",
        "media_caption",
        "media_hash",
        "media_duration",
        "origin",
        "latitude",
        "longitude",
        "thumb_image",
        "remote_resource",
        "received_timestamp",
        "send_timestamp",
        "receipt_server_timestamp",
        "receipt_device_timestamp",
        "read_device_timestamp",
        "played_device_timestamp",
        "raw_data",
        "recipient_count",
        "participant_hash",
        "starred",
        "quoted_row_id",
        "mentioned_jids",
        "multicast_id",
        "edit_version",
        "media_enc_hash",
        "payment_transaction_id",
        "forwarded",
        "preview_type",
        "send_count",
    ];
    protected $primaryKey = '_id';

    public static function findJId($key)
    {
        return static::byJId($key)->first();
    }

    public function chat_lists()
    {
        return $this->hasMany(
            ChatList::class,
            'key_remote_jid',
            'key_remote_jid'
        );
    }

    public function scopeWOrder(Builder $query, $column = 'received_timestamp')
    {
        return $query->orderBy('received_timestamp');
    }

    public function scopeByJId(Builder $query, $key)
    {
        return $query->where('key_remote_jid', $key);
    }

    public function getName()
    {
        if( Wa::isConnected() ) {
            $name = Wa::find($this->key_remote_jid)->getName();
        } else {
            $name = head(explode('@', $this->key_remote_jid));
        }
        return $name;
    }

    public function getDate()
    {
        return date("d-m-Y h:i:s a", $this->received_timestamp / 1000);
    }
}
