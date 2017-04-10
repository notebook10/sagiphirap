<!DOCTYPE html>
<html>
    <head>
        <title>PSME | {!! Theme::get('title') !!}</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf_token" content="{{ csrf_token() }}">
        <meta name="keywords" content="{!! Theme::get('keywords') !!}">
        <meta name="description" content="{!! Theme::get('description') !!}">
        <link href = "../images/psme-logo2.png" rel="icon" type="image/png">

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.13/css/jquery.dataTables.css">
        {!! Theme::asset()->styles() !!}
        {!! Theme::asset()->scripts() !!}

        <style>
            tbody tr td, th{text-align: center;}
            label.error{color:red;font-size:10px;}
            .chkbox{display: none;}
            #json{width:800px;}
        </style>
    </head>
    <body>
    <input type="hidden" id="baseurl" value="{{ URL::to('/') }}">
    <input type="hidden" id="token" value="{{ csrf_token() }}">
        {!! Theme::partial('header') !!}

        <div class="container">
            {!! Theme::content() !!}
        </div>

        {!! Theme::partial('footer') !!}

        {!! Theme::asset()->container('footer')->scripts() !!}
    </body>


    @include('includes/companymodal')
    @include('default/register')
    @include('includes/filter_report_modal')
    @include("includes/usermodal")
    @include("default/register")
</html>
