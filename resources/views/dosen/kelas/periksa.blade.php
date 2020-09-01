@extends('layouts.utama')

@section('content')
<div class="card">
    <div class="card-body card-periksa">
        <div class="row">
            <div class="col-md-9 col-sm-12">
                <h5>Nama Mahasiswa</h5>
                <p class="nama-univ">Nama Universitas</p>
            </div>
            <div class="col-md-3 col-sm-12 text-right">
                <a href="" class="btn btn-primary"><i class="fa fa-user-plus"></i> Undang Asisten</a>
            </div>
            <div class="col-md-12" style="margin-top:10px;">
                <form action="" class="form-row">
                    <div class="col-md-8" style="margin-top:10px;">
                        <textarea type="text" name="" class="form-control" id="" placeholder="Beri tanggapan atau evaluasi terkait kelas"></textarea>
                    </div>
                    <div class="col-md-2" style="margin-top:10px;">
                        <input type="number" min="0" max="100" class="form-control" placeholder="Nilai ...">
                    </div>
                    <div class="col-md-2" style="margin-top:10px;">
                        <input type="submit" value="Submit" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="card" style="margin-top:10px;">
    <div class="card-body">
        @for($c=1;$c<=5;$c++)
        <b style="color:black;">1. Judul Materi</b><br>
        <b>Deskripsi atau Intruksi Materi : </b><br>
        <p class="text-justify">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Perferendis libero omnis nisi ipsam, aspernatur debitis doloremque ab at sint illo a veniam mollitia temporibus nesciunt, fugiat molestiae? Voluptates, nemo voluptatum.</p>
        <b>Jawaban file : </b> <a href="" class="jawab-file"><i class="fa fa-download"></i> &nbsp;&nbsp;Namafile.pdf</a><br>
        <b>Jawaban text : </b><br>
        <p class="text-justify">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Perferendis libero omnis nisi ipsam, aspernatur debitis doloremque ab at sint illo a veniam mollitia temporibus nesciunt, fugiat molestiae? Voluptates, nemo voluptatum.</p>
        <div class="card">
            <div class="card-body reviewer-periksa">
                @for($i=1;$i<=5;$i++)
                <div class="row" style="margin-top:5px;">
                    <div class="col-md-1">
                         <img src="https://randomuser.me/api/portraits/men/26.jpg" class="rounded" width="50" alt="">
                    </div>
                    <div class="col-md-11 text-justify">
                        <b style="color:black;">Nama Reviewer</b><br>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Iste ab saepe voluptatum praesentium accusantium? Delectus praesentium nemo dolor architecto amet recusandae doloremque. Enim accusamus minima quam magni, necessitatibus culpa inventore.
                    </div>
                </div>
                @endfor
            </div>
        </div>
        <form action="" class="form-row" style="margin-top:10px;">
            <div class="col-md-8">
                <input type="text" name="" class="form-control" placeholder="Tulis review atau komentar ..." id="">
            </div>
            <div class="col-md-2">
                <input type="number" name="" min="0" max="100" class="form-control" placeholder="Nilai ..." id="">
            </div>
            <div class="col-md-2">
                <input type="submit" value="Submit" class="btn btn-primary">
            </div>
        </form>
        <hr>
        @endfor
    </div>
</div>
@endsection
