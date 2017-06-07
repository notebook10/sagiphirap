<!DOCTYPE html>
<?php use App\User; ?>
<?php ?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Paid Companies Report</title>
    <meta name="description" content="The HTML5 Herald">
    <style>
        body{font-family: Lato,Arial}
        .center{text-align: center;}
        .header{line-height: 5px;}
        .bgcolor{background: #d8d8d8;}
        td,th{font-size: 13px;}
        /*tr td:last-child{width:70px;padding: 2px;}*/
        tr,td{text-align: center;padding: 10px;}
        /*thead tr th{background-color: #d8d8d8;font-size: 14px; }*/
        /*.right{float:right;}*/
    </style>
</head>
<body>
    <h1 class="center header">Center for Sagip-Hirap Charity Foundation</h1>
    <p class="center header">Unit 1024 CityLand Shaw Tower Shaw Blvrd., Mandaluyong City</p>
    <p class="center header">Phone: (02) 910-4191</p>
    <div class="center bgcolor"><h2>{{ $title }}</h2></div>
    <div>
        <table border="1">
            <thead>
                <tr>
                    {{--<th>ID</th>--}}
                    <th>Company Name</th>
                    <th>Company Email</th>
                    <th>Contact Person</th>
                    <th>Contact Number</th>
                    <th>Contact Address</th>
                    <th>Amount Donated</th>
                    <th>Added By</th>
                    <th>Date Added (yyyy-mm-dd)</th>
                </tr>
            </thead>
            <tbody>
            @foreach($paidcompanies as $value)
                <tr>
                    {{--<td>{{ $value->id }}</td>--}}
                    <td>{{ $value->name }}</td>
                    <td>{{ $value->company_email }}</td>
                    <td>{{ $value->contact_person }}</td>
                    <td>{{ $value->contact_number }}</td>
                    <td>{{ $value->contact_address }}</td>
                    <td>{{ 'Php ' . number_format($value->amount) }}</td>
                    <td>{{ User::getuserbyid($value->agent_id)->firstname . ' ' . User::getuserbyid($value->agent_id)->lastname }}</td>
                    <td><?php echo date('Y-m-d',strtotime($value->created_at)); ?></td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="">
            <p>Total : {{ $total }} </p>
        </div>
    </div>
</body>
</html>