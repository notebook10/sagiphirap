<?php
    use App\User;
?>
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
                >EDIT</button> </td>
        </tr>
    @endforeach
    </tbody>
</table>
</div>