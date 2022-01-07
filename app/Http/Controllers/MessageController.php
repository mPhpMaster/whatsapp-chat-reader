<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMessageRequest;
use App\Http\Requests\UpdateMessageRequest;
use App\Models\ChatList;
use App\Models\Message;
use App\Models\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $show_media = $request->view == 'media';

        $list = collect();
        ChatList::has('messages')
                ->with('messages')
                ->WOrder()
                ->get([
                          '_id',
                          'key_remote_jid',
                          'subject',
                      ])
                ->map(function ($chat_list) use (&$list) {
//                    $key_remote_jid = Str::before(Str::before($chat_list->key_remote_jid, '-'), '@');
                    $key_remote_jid = $chat_list->key_remote_jid;
                    $list->add([
                                   '_id'            => $chat_list->_id,
                                   'subject'            => $chat_list->subject,
                                   'key_remote_jid' => $key_remote_jid,
                               ]);
                });

        return view('index', [
            'list'       => $list->unique('key_remote_jid'),
            'show_media' => $show_media,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\ChatList $id
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show(Request $request, int $id)
    {
        $model = ChatList::find($id);
        $show_media = $request->view == 'media';
        return view('show', [
            'r'          => $model,
            'show_media' => $show_media,
            'container_class' => 'for-all',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\StoreMessageRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMessageRequest $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Message $message
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateMessageRequest $request
     * @param \App\Models\Message                     $message
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMessageRequest $request, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Message $message
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Message $message)
    {
        //
    }
}
