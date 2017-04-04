<style>td{text-align: center;}</style>

<a href="/admin/dashboard" class="btn btn-primary back-btn"><< Back</a>
<table id="tbl_users" class="display" cellspacing="0" width="100%">
    <thead>
    <tr>
        <th>Fullname</th>
        <th>Email</th>
        <th>Contact Number</th>
        <th>Address</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach($users as $key => $value)
        <tr>
            <td>{{ $value->firstname . " " . $value->lastname }}</td>
            <td>{{ $value->email }}</td>
            <td>{{ $value->contact_number }}</td>
            <td>{{ $value->address }}</td>
            <td>
                <button class="btn btn-success edituser" data-id="{{ $value->id }}">Edit</button>
                <button class="btn btn-primary changepass" data-id="{{ $value->id }}">Change Password</button>
                <button class="btn btn-danger deleteuser" data-id="{{ $value->id }}">Delete</button>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>