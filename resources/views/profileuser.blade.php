@extends('layouts.utama')

@section('js')
<script>
  $("input:checkbox").click(function() {
    var bol = $("input:checkbox:checked").length >= 3;     
    $("input:checkbox").not(":checked").attr("disabled",bol);
    });
</script>
@endsection

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
@php
    $user = Auth::user();
    $bio = ($user->level == 0) ? $user->mahasiswa : $user->dosen;
@endphp
<div class="card">
    <div class="card-body">
        <form action="{{url(''.session('akses').'/profile-store')}}" method="POST" class="row">
            @csrf
            <input type="hidden" name="_method" value="put">
            <input type="hidden" name="usr" value="{{Auth::user()->id}}">
            <div class="form-group col-md-6">
                <label for="">Nama Lengkap</label>
                <input type="text" name="nama" value="{{$usr->fullname}}" class="form-control" id="" placeholder="Nama Lengkap">
            </div>
            <div class="form-group col-md-6">
            @if(Auth::user()->level == 0)
                <label for="">NIM</label>
                <input type="text" name="nim" class="form-control" id="" value="{{$bio->nim}}" placeholder="NIM">
            @elseif(Auth::user()->level == 1)
                <label for="">NIDN</label>
                <input type="text" name="nidn" class="form-control" value="{{$bio->nidn}}" id="" placeholder="NIDN">
            @endif
            </div>
            <div class="form-group col-md-6">
                <label for="">Program Studi</label>
                <input type="text" name="prodi" class="form-control" id="" value="{{$bio->prodi}}" placeholder="Program Studi">
            </div>
            <div class="form-group col-md-6">
                <label for="">Perguruan Tinggi</label>
                <input type="text" name="univ" class="form-control" id="" value="{{$bio->univ}}" placeholder="Nama Perguruan Tinggi">
            </div>

            @if(Auth::user()->level == 0)
            <div class="col-md-12">
                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                            @foreach($kat as $k)
                            <div class="panel panel-default">
                              <div class="panel-heading" role="tab" id="headingOne">
                                <h4 class="panel-title">
                                  <a role="button" data-toggle="collapse" data-parent="#accordion" href="#dataKat{{$k->id}}" aria-expanded="true" aria-controls="collapseOne">
                                    {{$k->kat_nama}}<i class="fa fa-angle-down"></i>
                                  </a>
                                </h4>
                              </div>
                              <div id="dataKat{{$k->id}}" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                <div class="panel-body">
                                    @foreach($k->detail_kategori as $cu)
                                    <label>
                                      <input type="checkbox" name="peminatan[]" rel="dkat{{$cu->id}}" value="{{$cu->id}}" @if($cu->id == $bio->id_peminatan1 || $cu->id == $bio->id_peminatan2 || $cu->id == $bio->id_peminatan3) checked @endif/>
                                      {{$cu->dkat_nama}}
                                    </label><br>
                                    @endforeach
                                </div>
                              </div>
                            </div>
                            @endforeach
                </div>
            </div>
            @endif
            <div class="col-md-12">
                <input type="submit" value="Submit" class="btn btn-primary">
            </div>
        </form>
    </div>
</div>
@endsection