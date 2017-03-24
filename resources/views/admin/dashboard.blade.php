<?php
    use App\User;
?>
<head>
    <meta name="csrf_token" content="{{ csrf_token() }}">
    <input type="hidden" id="baseurl" value="{{ URL::to('/') }}">
    <input type="hidden" id="token" value="{{ csrf_token() }}">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.13/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/sweetalert.css') }}">
    <style>
        tbody tr td{text-align: center;}
        label.error{color:red;font-size:10px;}
    </style>

    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/datatables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/dashboard.css') }}">
    {{--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>--}}
    <script src="{{ asset('js/jquery-3.1.1.js') }}"></script>
    <script src="{{ asset('js/bootstrap/bootstrap.min.js') }}"></script>
    {{--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>--}}
    {{--<script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.13/js/jquery.dataTables.js"></script>--}}
    <script src="{{ asset('js/jquery.datatables.js') }}"></script>
    <script src="{{ asset('js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('js/sweetalert.min.js') }}"></script>
    <script src="{{ asset('js/scripts.js') }}"></script>
</head>
@include('includes/header')
<div class="container">
    {{--<a href="logout" class="btn btn-danger">Logout</a>--}}
    <button id="addcompany" class="btn btn-primary ">ADD COMPANY</button>
    {{--<p>Current User: <i>{{ Auth::user()->firstname . ' ' . Auth::user()->lastname }}</i></p>--}}
    <input type="hidden" id="auth_id" value="{{ Auth::user()->id }}" data-usertype="{{ Auth::user()->user_type }}">
    <table id="tbl_company" class="display" cellspacing="0" width="100%">
        <thead>
        <tr>
            <th>Company Name</th>
            <th>Description</th>
            <th>Contact Person</th>
            <th>Contact Number</th>
            <th>Agent ID</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data as $key => $value)
            <tr>
                <td>{{ htmlspecialchars($value->name) }}</td>
                <td>{{ substr(htmlspecialchars($value->description),0,50) }}...</td>
                <td>{{ htmlspecialchars($value->contact_person) }}</td>
                <td>{{ htmlspecialchars($value->contact_number) }}</td>
                <td>{{ \App\User::getuserbyid($value->agent_id)->firstname . " " . \App\User::getuserbyid($value->agent_id)->lastname }}</td>
                <td><button class="btn btn-success btnedit" data-id="{{ htmlspecialchars($value->id) }}" data-agent="{{ htmlspecialchars($value->agent_id) }}"
                            {{--<?php--}}
                            {{--if(Auth::user()->id != $value->agent_id){--}}
                            {{--?>  <?php--}}
                        {{--}--}}
                        {{--?>--}}
                    >EDIT</button> </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>



@include('includes/companymodal')
@include('default/register')