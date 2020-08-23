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
            <td>Event Name</td>
            <td>Start DateTime</td>
            <td>End DateTime</td>
            <td>Meet Link</td>
        </tr>
        @foreach ($events as $event)
        <tr>
            <td>{{$event['summary']}}</td>
            <td>{{$event['start']['dateTime']}}</td>
            <td>{{$event['end']['dateTime']}}</td>
            <td>{{$event['hangoutLink']}}</td>
        </tr>
        @endforeach
    </table>
</body>
</html>
