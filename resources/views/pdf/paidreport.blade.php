<!DOCTYPE html>
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
        td:nth-child(odd) { background: #d8d8d8;}
        td:nth-child(even) {background: #eeeeee;}
        tr td:last-child{width:70px;padding: 2px;}
        tr,td{text-align: center;padding: 10px;}
    </style>
</head>
<body>
    <h1 class="center header">Center for Sagip-Hirap Charity Foundation</h1>
    <p class="center header">Unit 1024 CityLand Shaw Tower Shaw Blvrd., Mandaluyong City</p>
    <p class="center header">Phone: (02) 910-4191</p>
    <div class="center bgcolor"><h2>{{ $title }}</h2></div>
    <div>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Company Name</th>
                    <th>Contact Person</th>
                    <th>Contact Number</th>
                    <th>Contact Address</th>
                    <th>Date Added</th>
                </tr>
            </thead>
            <tbody>
            @foreach($paidcompanies as $value)
                <tr>
                    <td>{{ $value->id }}</td>
                    <td>{{ $value->name }}</td>
                    <td>{{ $value->contact_person }}</td>
                    <td>{{ $value->contact_number }}</td>
                    <td>{{ $value->contact_address }}</td>
                    <td><?php echo date('Y-m-d',strtotime($value->created_at)); ?></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>