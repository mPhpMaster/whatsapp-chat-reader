@extends('layout')

@section('content')
    <a class="back-link fr" href="{{route('msgs.index')}}?{{$show_media?'view=media':''}}">Chat list</a>
    @include('connection')
    <hr />

    @foreach($list as $r)
        <div class="msg link">
            <a class="mcontact" href="{{route('db.show', $r['id'])}}?{{$show_media?'view=media':''}}">
                {{$r['name']}}
            </a>
        </div>
    @endforeach
@endsection
