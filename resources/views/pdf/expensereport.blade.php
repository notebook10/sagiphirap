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
        .header{line-height: 1px;}
        .bgcolor{background: #d8d8d8;}
        td,th{font-size: 11px;}
        /*tr td:last-child{width:70px;padding: 2px;}*/
        tr,td{text-align: center;padding: 5px;}
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
        <table border="1" width="100%">
            <thead>
                <tr>
                    {{--<th>ID</th>--}}
                    <th>Category</th>
                    <th>Description</th>
                    <th>Amount</th>
                    <th>Date</th>
                    <th>Admin</th>
                </tr>
            </thead>
            <tbody>
            @foreach($allExpenses as $value)
                <tr>
                    <td>{{ $value->category }}</td>
                    <td>{{ $value->description }}</td>
                    <td>{{ $value->amount }}</td>
                    <td>{{ date('Y-m-d',strtotime($value->created_at)) }}</td>
                    <td>{{ User::getuserbyid($value->admin_id)->firstname . ' ' . User::getuserbyid($value->admin_id)->lastname }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="">
            <p>Total : {{ $totalexpense }} </p>
        </div>
    </div>
</body>
</html>