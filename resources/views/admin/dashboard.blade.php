<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.13/css/jquery.dataTables.css">
<style>
    tbody tr td{text-align: center;}
</style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.13/js/jquery.dataTables.js"></script>
<script src="{{ asset('js/jquery.validate.min.js') }}"></script>
<script>
    $('document').ready(function(){
        $('#tbl_company').DataTable();
        $('#addcompany').on('click',function(){
            $('#myModal').modal('show');
        });
        $('.btnedit').on('click',function(){
            alert($(this).data('agent'));
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
    });
</script>

DASHBOARD
<a href="logout">Logout</a>
<button id="addcompany" class="btn btn-primary ">ADD COMPANY</button>
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
                <td><button class="btn btn-success btnedit" data-id="{{ $value->id }}" data-agent="{{ $value->agent_id }}">EDIT</button> </td>
            </tr>
        @endforeach
    </tbody>
</table>

@include('includes/companymodal')