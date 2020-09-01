@extends('layouts.utama')

@section('content')
<div class="card" style="background: linear-gradient(92.71deg, #3C6E71 52.76%, rgba(40, 75, 99, 0) 108.41%);">
    <div class="card-body row">
        <div class="col-md-2">
            <img src="{!! Auth::user()->avatar !!}" width="100px" class="rounded" alt="">
        </div>
        <div class="col-md-8" style="font-family: Montserrat;font-style: normal;font-size: 18px;line-height: 22px;color:white;">
            <h5 style="font-weight: 500;">{{Auth::user()->fullname}}</h5>
            <h6>Universitas Pendidikan Manohara</h6>
            
        </div>
    </div>
</div>
<br>
<div class="card">
    <div class="card-body">
        <form action="@if(Auth::user()->level == 0) {{route('')}}" class="row">
            <div class="form-group col-md-6">
                <label for="">Nama Lengkap</label>
                <input type="text" name="name" class="form-control" id="" placeholder="Nama Lengkap">
            </div>
            <div class="form-group col-md-6">
            @if(Auth::user()->level == 0)
                <label for="">NIM</label>
                <input type="text" name="nim" class="form-control" id="" placeholder="NIM">
            @elseif(Auth::user()->level == 1)
                <label for="">NIDN</label>
                <input type="text" name="nidn" class="form-control" id="" placeholder="NIDN">
            @endif
            </div>
            <div class="form-group col-md-6">
                <label for="">Program Studi</label>
                <input type="text" name="prodi" class="form-control" id="" placeholder="Program Studi">
            </div>
            <div class="form-group col-md-6">
                <label for="">Perguruan Tinggi</label>
                <input type="text" name="prodi" class="form-control" id="" placeholder="Nama Perguruan Tinggi">
            </div>
            <div class="col-md-12">
                <input type="submit" value="Submit" class="btn btn-primary">
            </div>
        </form>
    </div>
</div>
@endsection