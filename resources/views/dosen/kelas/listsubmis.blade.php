@extends('layouts.utama')

@section('js')
<script>
    $('.panel-collapse').on('show.bs.collapse', function () {
              $(this).siblings('.panel-heading').addClass('active');
            });

            $('.panel-collapse').on('hide.bs.collapse', function () {
              $(this).siblings('.panel-heading').removeClass('active');
            });
</script>
@endsection

@section('heading')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/"><i aria-hidden="true" class="fa fa-home"></i> Home</a></li>
            <li class="breadcrumb-item"><a href="/dosen/kelas"></i> Kelas</a></li>
            <li class="breadcrumb-item"><a href="{{route('listsubmis',$mt->kelas->id)}}"></i> Lihat Detail Kelas</a></li>
            <li class="breadcrumb-item"><a></i> Submission Materi - {{$mt->judul}}</a></li>
        </ol>
    </nav>
@endsection

@section('content')
<div class="row">
  <div class="col-sm-12">
    <div class="card text-white kelasheader">
      <div class="card-body">
        <h3 class="card-title" style="font-weight:700;">Submission dari materi {{$mt->judul}}</h3>
        <p class="card-text">Di bawah ini daftar submission dari setiap mahasiswa</p>
      </div>
    </div>
  </div>
</div>
<div class="row" style="margin-top:30px;">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="row" style="margin-top:20px;">
                    @for($a=1;$a<=10;$a++)
                    <div class="col-md-6" style="margin-top:10px;">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-2">
                                        <img src="https://randomuser.me/api/portraits/men/14.jpg" class="rounded" width="50" alt="">
                                    </div>
                                    <div class="col-md-10">
                                        <h5 class="card-title" style="color:black;"> Nama Mahasiswa</h5>
                                        <h6 style="margin-top:-10px;">Nama Universitas</h6>
                                        <a href="{{route('periksa',1)}}" class="btn btn-primary" style="padding:0px 5px;">Periksa Kerjaan</a>
                                    </div>
                                </div>
                                
                                <p class="card-text">
                                    <i class="fa fa-star"></i> 90
                                </p>
                                <div class="review">
                                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                        <div class="panel panel-default">
                                            <div class="panel-heading" role="tab" id="headingOne">
                                                <h4 class="panel-title">
                                                <a role="button" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);" data-toggle="collapse" data-parent="#accordion" href="#review{{$a}}" aria-expanded="true" aria-controls="collapseOne">
                                                    Review<i class="fa fa-angle-down"></i>
                                                </a>
                                                </h4>
                                            </div>
                                            <div id="review{{$a}}" class="panel-collapse collapse in list-review" role="tabpanel" style="margin-top:20px;" aria-labelledby="headingOne">
                                                <div class="panel-body">
                                                    <div class="row">
                                                        @for($i=1;$i<=10;$i++)
                                                        <div class="col-md-2">
                                                            <img src="https://randomuser.me/api/portraits/women/3.jpg" class="rounded" width="50" alt="">
                                                        </div>
                                                        <div class="col-md-10 text-justify" style="margin-left:-5px;">
                                                            <h6 style="color:black;font-weight:700">Reviewer {{$i}}</h6>
                                                            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Earum officiis nihil similique provident cumque, omnis necessitatibus quas eveniet tempora non facere. Velit optio obcaecati voluptatem tempore porro praesentium cupiditate eos!</p>
                                                        </div>
                                                        @endfor
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endfor
                </div>
            </div>
        </div>
    </div>
</div>
@endsection