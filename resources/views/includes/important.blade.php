<meta name="csrf_token" content="{{ csrf_token() }}">
<input type="hidden" id="baseurl" value="{{ URL::to('/') }}">
<input type="hidden" id="token" value="{{ csrf_token() }}">