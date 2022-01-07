@extends('layout')

@section('content')
    <a class="back-link fr" href="{{route('msgs.index')}}?{{$show_media?'view=media':''}}">Back</a>
    @include('connection')
    <h2 class="mcontact">
        <small style="font-size: x-small">{{$r['key_remote_jid']}}</small><br>
        {{\App\Models\Wa::find($r['key_remote_jid'])->getName()}}
    </h2>

    <hr />

    @foreach($r->messages as $r2)
            @if (empty(trim($r2['data'])))
                @continue
            @endif
            <div class="msg {{$r2['key_from_me'] ? 'own' : 'there'}} {{$show_media ? 'just_media' : ''}}">
                <p class="mp{{$r2['media_mime_type'] == NULL ? "" : "r"}}">
                    @if($r2['media_mime_type'] == NULL)
                        {{$r2['data']}}
                    @else
                        <span>media-> {{$r2['media_mime_type']}}</span>
                        {!! getMediaOf($r2) !!}
                    @endif
                </p>
                <small class="mdate">{{$r2->getDate()}}</small>
            </div>
        @endforeach
@endsection
