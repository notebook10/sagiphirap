<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf_token" content="{{ csrf_token() }}">
<input type="hidden" id="baseurl" value="{{ URL::to('/') }}">
<input type="hidden" id="token" value="{{ csrf_token() }}">