@extends('layout')

@section('content')
    <a class="back-link fr" href="{{route('db.index')}}?{{$show_media?'view=media':''}}">Change DB</a>
    @include('connection')
    <hr />
    {{--    @dd($list[1])--}}
    @foreach($list as $r)
        <div class="msg link">
        <a class="mcontact" href="{{route('msgs.show', $r['_id'])}}?{{$show_media?'view=media':''}}">
            {{\App\Models\Wa::find($r['key_remote_jid'])->getName()}}
        </a>
        </div>
    @endforeach
@endsection
