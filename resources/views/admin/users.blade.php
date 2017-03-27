<!DOCTYPE html>
<html lang="en">
    <head>
        @include("includes/important")
        @include("includes/config")
        <script src="{{ asset('js/users.js') }}"></script>
    </head>
    <body>
        USERS
        <style>td{text-align: center;}</style>
        <table id="tbl_users">
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
                        <button class="btn btn-danger deleteuser">Delete</button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @include("includes/usermodal")
    @include("default/register")
    </body>
</html>