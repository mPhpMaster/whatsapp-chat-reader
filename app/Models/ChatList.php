<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Model;
use Illuminate\Http\Request;

class ChatList extends Model
{
    use HasFactory;

    protected $primaryKey = '_id';
    protected $table = "chat_list";
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

    public function getRouteKey()
    {
        return parent::getRouteKey(); // TODO: Change the autogenerated stub
    }

    public function messages()
    {
        return $this->hasMany(
            Message::class,
            'key_remote_jid',
            'key_remote_jid'
        );
    }

    public function scopeMediaMimeTypeNotNull(Builder $query)
    {
        return $query->whereNotNull('media_mime_type');
    }

    public function scopePrepareMediaMimeTypeFromRequest(Builder $query, Request $request = null)
    {
        $request = ($request ?? request());
        return $query->when($request->view == 'media', fn($q) => $q->whereNotNull('media_mime_type'));
    }

    public function getName()
    {
        return head(explode('@', $this->key_remote_jid));
    }

    public function scopeWOrder(Builder $query, $column = 'received_timestamp')
    {
        return $query->orderBy('received_timestamp');
    }
    public function getDate()
    {
        return date("d-m-Y h:i:s a",$this->received_timestamp/1000);
    }
}
