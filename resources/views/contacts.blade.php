<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{url('css/app.css')}}">
    <title>Document</title>
</head>
<body>
    <table>
        <tr>
            <td>Name</td>
            <td>Phone</td>
        </tr>
        @foreach ($results['connections'] as $contact)
        <tr>
            <td>{{$contact['names'][0]['displayName']}}</td>
            <td>{{$contact['phoneNumbers'][0]['value']}}</td>
        </tr>
        @endforeach
    </table>
</body>
</html>
