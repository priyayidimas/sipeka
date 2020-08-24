@php
    $kategori = App\Model\Kategori::all();
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

    <table>
        <tr>
            <td>Kategori</td>
            <td>Detail Kategori</td>
        </tr>
        @foreach ($kategori as $kat)
            @foreach ($kat->detail_kategori as $dkat)
            <tr>
                <td>{{$kat->kat_nama}}</td>
                <td>{{$dkat->dkat_nama}}</td>
            </tr>
            @endforeach
        @endforeach
    </table>

    <h5>Insert Kategori</h5>
    <form action="{{url('/debug/kategori')}}" method="post">
        @csrf
        <input type="text" name="kat_nama">
        <button type="submit">Submit</button>
    </form>

    <h5>Insert DKategori</h5>
    <form action="{{url('/debug/dkategori')}}" method="post">
        @csrf
        <input type="text" name="dkat_nama">
        <select name="kat_id" id="">
            @foreach ($kategori as $kat)
            <option value="{{$kat->id}}">{{$kat->kat_nama}}</option>
            @endforeach
        </select>
        <button type="submit">Submit</button>
    </form>
</body>
</html>
