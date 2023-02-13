<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Email Records</h1>
    <table>
        <thead>
            <tr>
                <th>S.No</th>
                <th>Name</th>
                <th>status</th>
                <th>Content</th>
            </tr>
        </thead>
        <tbody>
            @foreach($records as $record)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$record->employee->name}}</td>
                <td>{{$record->status}}</td>
                <td>{!! $record->email_content !!}</td>
            </tr>
            @endforeach
        </tbody>


    </table>
</body>

</html>