@extends('layouts.utama')

@section('title')
    Tambah Kelas
@endsection

@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script src="/assets/js/jquery.multifield.min.js"></script>
<script>
    $('#dasar').multifield({
        section: '.group',
        btnAdd:'#btn-add1',
        btnRemove:'.btnRemove',
    });
</script>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{route('storekelas')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Nama Kelas</label>
                        <input type="text" name="kelas_nama" class="form-control" placeholder="Nama Kelas ..." id="" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Kategori Kelas</label>
                        <select name="dkat_id" id="" class="form-control js-example-basic-single" required>
                            <option disabled value="">Pilih Kategori Kelas</option>
                            @foreach($dkategori as $q)
                            <option value="{{$q->id}}">{{$q->dkat_nama}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Deskripsi Kelas</label>
                        <input type="text" name="desc" class="form-control" placeholder="Deskripsi Kelas ..." id="" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Group Telegram</label>
                        <input type="text" name="link_tel" class="form-control" placeholder="Link Group Telegram ..." id="" required>
                    </div>
                </div>
                <div class="col-md-12">
                    <div id="dasar" class="card-body content">
                                    <button class="btn btn-primary" type="button" id="btn-add1">Tambah Materi</button><br><br>
                                    <div class="group">
                                        <div class="form-row">
                                            <div class="col-md-11">
                                                <div class="row">
                                                    <div class="col-md-10">
                                                        <div class="position-relative form-group">
                                                            <label for="">Judul Materi</label>
                                                            <input name="judul[]" placeholder="Judul Materi ..." type="text" class="form-control" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-10">
                                                        <div class="position-relative form-group">
                                                            <label for="">Deskripsi Materi/Pertanyaan</label>
                                                            <textarea name="desc_materi[]" class="form-control" id="" rows="3"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <div class="position-relative form-group">
                                                            <label for="">Jenis Materi</label>
                                                            <select name="jenis[]" id="" class="form-control" required>
                                                                <option value="">Pilih Jenis Materi</option>
                                                                <option value="0">Materi</option>
                                                                <option value="1">Pertanyaan</option>
                                                                <option value="2">Materi dan Pertanyaan</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <div class="position-relative form-group">
                                                            <label for="">Modul Materi</label>
                                                            <input name="filemodul[]" placeholder="Pertanyaan ..." type="file" class="form-control-file">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <div class="position-relative form-group">
                                                            <label for="">ID Video Youtube</label>
                                                            <input name="idytb[]" placeholder="Masukkan ID YouTube ..." type="text" class="form-control" required>
                                                            <i style="font-size:12px;">https://www.youtube.com/watch?v=<b style="color:blue;">idyoutube</b></i>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <div class="position-relative form-group">
                                                            <label for="">Status Modul</label>
                                                            <select name="statusfile[]" id="" class="form-control" required>
                                                                <option value="">Pilih Status Modul</option>
                                                                <option value="0">Public</option>
                                                                <option value="1">Private</option>
                                                            </select>
                                                        </div>
                                                        <i style="font-size:12px;"><b>Public</b> akan tersedia di perpustakaan, <b>Private</b> hanya untuk materi di kelas</i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                <div class="position-relative form-group">
                                                    <button type="button" class="btn btn-danger btnRemove"><i class="fa fa-times-circle"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                </div>
                </div>
                <div class="col-md-12 text-right">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection