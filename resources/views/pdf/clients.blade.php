<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <title></title>
</head>
<body>
    <table class="table table-bordered table-striped table-sm">
        <thead>
            <tr>
                <th class="text-center">id</th>
                <th class="text-center">Nombre</th>
            </tr>
        </thead>
        <tbody>
            @foreach($customers as $customer)
            <tr>
                <td>{{ $customer->id }}</td>
                <td>{{ $customer->name_client }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>