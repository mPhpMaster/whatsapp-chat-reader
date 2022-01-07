<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>Title</title>

    <style type="text/css">
        body {
            background-color: #131c21;
        }

        .msg {
            padding: .5px 6px;
            border-radius: 20px;
            background-color: #262d31;
            margin: .7em;
            color: white;
            position: relative;
            overflow-wrap: break-word;
        }

        .mp {
            /*text-align: end;*/
            font-family: Tahoma, serif;
        }

        .wmedia {
            text-align: start;
        }

        .mdate {
            /*text-align: start;*/
            padding: 8px;
            font-size: 10px;
        }

        .msg.own {
            background-color: #056162;
            color: white;
        }

        .there .mp, .there .mdate{
            text-align: start !important;
        }
        .own .mp, .own .mdate {
            text-align: end !important;
        }

        .just_media {
            width: auto;
            display: inline-block;
        }

        .just_media span {
            display: block;
        }

        .for-all {
            width: 50%;
            margin: auto;
        }
        .own + .there, .there + .own {
            margin-top: 1.5em;
        }
        .mcontact {
            color: white;
            margin-top: 2em;
        }
        .link {
            text-align: center;
            padding: 10px;
            width: 46%;
            float: right;
        }
        .back-link {
            color: white;
            text-decoration: none;
            padding: 5px;
            background-color: #056162;
        }
        .fr {
            float: right;
        }
    </style>

</head>
<body>
<div class="{{$container_class ?? ''}}">
    @yield('content')
</div>

</body>
</html>
