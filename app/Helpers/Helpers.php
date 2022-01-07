<?php

function getMediaOf($r2)
{
    if( !($media_mime_type = data_get($r2, 'media_mime_type', null)) ) {
        return "";
    }

    if( !$r2[ 'remote_resource' ] ) {
        return "<small>Media Not Found!</small>";
    }

    switch( $media_mime_type ) {
        case 'audio/amr':
        case 'audio/mp4':
        case 'audio/3gpp':
            $data = "data:" . $r2[ 'media_mime_type' ] . ';base64,' . base64_encode($r2[ 'remote_resource' ]);
        $data = '
					<audio controls>
					  	<source src="' . $data . '" type="' . $r2[ 'media_mime_type' ] . '">
						audio element
					</audio>
					';
        break;
        default:
            $data = "data:" . $r2[ 'media_mime_type' ] . ';base64,' . base64_encode($r2[ 'raw_data' ]);
            $data = "<img src='$data'>";
    }

    return <<<HTML
<div class='wmedia'>
{$data}
</div>
HTML;

}
