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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.13/js/jquery.dataTables.js"></script>
    <script src="{{ asset('js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('js/sweetalert.min.js') }}"></script>
    <script>
        $('document').ready(function(){
            var BASE_URL = $('#baseurl').val();
            loadClientCompaniesDataTable();
            $('#addcompany').on('click',function(){
                $('#companyModal').modal('show');
            });
            $('.btnedit').on('click',function(){
                swal("Here's a message!", "Not yet available");
            });
            $('#frmcompany').validate({
                rules : {
                    'comp_name' : 'required',
                    'comp_desc' : 'required',
                    'comp_contact_person' : 'required',
                    'comp_contact_number' : {
                        required : true,
                        number: true
                    },
                    'comp_address' : 'required'
                }
            });
            $('#btnSubmitCompany').on('click',function(){
                if($('#frmcompany').valid()){
                    swal({
                            title: "Save?",
                            text: "Save ba?",
                            type: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "Yes, save it!",
                            cancelButtonText: "No, cancel plx!",
                            closeOnConfirm: false,
                            closeOnCancel: false
                        },
                        function(isConfirm){
                            if(isConfirm){
                                $.ajax({
                                    'url' : BASE_URL + '/admin/submitcompany',
                                    type : 'POST',
                                    data : {
                                        _token : $('[name="csrf_token"]').attr('content'),
                                        name : $('#comp_name').val(),
                                        desc : $('#comp_desc').val(),
                                        cperson : $('#comp_contact_person').val(),
                                        cnumber : $('#comp_contact_number').val(),
                                        caddress : $('#comp_address').val()
                                    },
                                    success : function(response){
                                        swal("Success!", "Successfully saved!", "success");
                                        $('button.confirm').on('click',function(){
                                            $('#companyModal').modal('hide');
                                            location.reload();
                                        });
                                    },
                                    error : function(xhr,me,error){
                                        swal("Error!", error, "error");
                                    }
                                });
                            }else{
                                swal("Cancelled", "Your imaginary file is safe :)", "error");
                            }
                        });
                }
            });
        });
        function loadClientCompaniesDataTable(){
            $('#tbl_company').DataTable();
        }
    </script>
</head>

<a href="logout" class="btn btn-danger">Logout</a>
<button id="addcompany" class="btn btn-primary ">ADD COMPANY</button>
<p>Current User: <i>{{ Auth::user()->firstname . ' ' . Auth::user()->lastname }}</i></p>
<input type="hidden" id="auth_id" value="{{ Auth::user()->id }}">
<table id="tbl_company">
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
                <td>{{ $value->name }}</td>
                <td>{{ $value->description }}</td>
                <td>{{ $value->contact_person }}</td>
                <td>{{ $value->contact_number }}</td>
                <td>{{ $value->agent_id }}</td>
                <td><button class="btn btn-success btnedit" data-id="{{ $value->id }}" data-agent="{{ $value->agent_id }}"
                    <?php
                        if(Auth::user()->id != $value->agent_id){
                            ?> disabled <?php
                        }
                    ?>
                    >EDIT</button> </td>
            </tr>
        @endforeach
    </tbody>
</table>

@include('includes/companymodal')