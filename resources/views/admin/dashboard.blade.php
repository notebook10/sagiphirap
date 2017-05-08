<?php
    use App\User;
?>

<h2>List of Company Client</h2>
<button id="addcompany" class="btn btn-primary ">ADD COMPANY</button>
{{--<p>Current User: <i>{{ Auth::user()->firstname . ' ' . Auth::user()->lastname }}</i></p>--}}
<input type="hidden" id="auth_id" value="{{ Auth::user()->id }}" data-usertype="{{ Auth::user()->user_type }}">
<table id="tbl_company" class="display" cellspacing="0" width="100%">
    <thead>
    <tr>
        <th>Company Name</th>
        <th>Email</th>
        <th>Notes</th>
        <th>Contact Person</th>
        <th>Contact Number</th>
        <th>Vouch</th>
        <th>Amount Donated</th>
        <th>Agent Name</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach($data as $key => $value)
        <tr>
            <td>{{ htmlspecialchars($value->name) }}</td>
            <td>{{ htmlspecialchars($value->company_email) }}</td>
            <td>{{ substr(htmlspecialchars($value->description),0,50) }}...</td>
            <td>{{ htmlspecialchars($value->contact_person) }}</td>
            <td>{{ htmlspecialchars($value->contact_number) }}</td>
            <td>{{ $value->confirm == 1 ? 'Approved' : 'Undecided' }}</td>
            <td>{{ $value->amount }}</td>
            <td>{{ \App\User::getuserbyid($value->agent_id)->firstname . " " . \App\User::getuserbyid($value->agent_id)->lastname }}</td>
            <td><button class="btn btn-success btnedit" data-id="{{ htmlspecialchars($value->id) }}" data-agent="{{ htmlspecialchars($value->agent_id) }}"
                >EDIT</button> </td>
        </tr>
    @endforeach
    </tbody>
</table>
</div>