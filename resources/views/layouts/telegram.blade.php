@extends('layouts.utama')

@section('css')
<link rel="stylesheet" href="/assets/css/bootstrap-datetimepicker.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.21.0/moment.min.js" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="/assets/js/bootstrap-datetimepicker.min.js"></script>
        <script type="text/javascript">
            $(function () {
                $('#datetimepicker1').datetimepicker({
                  format: 'DD MMMM YYYY @ HH:mm'
                });
                $('#datetimepicker2').datetimepicker({
                  format: 'DD MMMM YYYY @ HH:mm'
                });
                $('.js-example-basic-single').select2();

                $('#editPertemuan').on('show.bs.modal', function (event) {
                    var button = $(event.relatedTarget);
                    var namaacara = button.data('namaevent');
                    var descacara = button.data('descevent');
                    var waktu = button.data('waktuevent');
                    var kelas = button.data('kelas');
                    var idevent = button.data('kdevent');

                    var modal = $(this);
                    modal.find('.modal-body #namaevent').val(namaacara);
                    modal.find('.modal-body #descevent').val(descacara);
                    modal.find('.modal-body .waktuevent').val(waktu);
                    modal.find('.modal-body #kelas').val(kelas);
                    modal.find('.modal-body #kdevent').val(idevent);
                });
            });
        </script>
@endsection

@section('heading')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('')}}"><i aria-hidden="true" class="fa fa-home"></i> Home</a></li>
            <li class="breadcrumb-item"><a>Group Chat</a></li>
        </ol>
    </nav>
@endsection

@section('content')
<!-- Content Row -->
    <div class="row">
        <script async src="https://comments.app/js/widget.js?3" data-comments-app-website="lvK34rdO" data-limit="20"></script>
    </div>



@endsection
