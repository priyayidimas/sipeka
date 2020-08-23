<!doctype html>
    <html>
        <head>
            <meta charset='utf-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1'>
            <title>Pelengkapan Biodata Dosen</title>
            <link href='https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css' rel='stylesheet'>
            <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css' rel='stylesheet'>
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
            <link rel="stylesheet" href="/assets/css/biodata.css">
            
            <script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
            <script type='text/javascript' src='https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js'></script>
            <script type='text/javascript' src='https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js'></script>
            <script src="/assets/js/biodata.js"></script>
        </head>
        <body>
                            <!-- MultiStep Form -->
            <div class="container-fluid" id="grad1">
                <div class="row justify-content-center mt-0">
                    <div class="col-11 col-sm-9 col-md-7 col-lg-6 text-center p-0 mt-3 mb-2">
                        <div class="card px-0 pt-4 pb-0 mt-3 mb-3">
                            <div class="row">
                                <div class="col-md-12">
                                    <img src="/assets/img/sipekawarna.png" width="135px" height="90px" alt="">
                                    <h2><strong>Pelengkapan Data Mahasiswa</strong></h2>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 mx-0">
                                    <form id="msform">
                                        <!-- progressbar -->
                                        <ul id="progressbar">
                                            <li class="active" id="account"><strong>Biodata</strong></li>
                                            <li id="personal"><strong>Peminatan</strong></li>
                                            <li id="confirm"><strong>Selesai</strong></li>
                                        </ul> <!-- fieldsets -->
                                        <fieldset>
                                            <div class="form-card">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="">Nama Mahasiswa</label>
                                                            <input type="text" name="namamhs" class="form-control" placeholder="Nama Mahasiswa"/>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="">Nomor Handphone</label>
                                                            <input type="number" name="nomorhp" class="form-control" placeholder="62"/>
                                                            <i style="font-size:12px;color:grey;">Contoh : 628123xxx</i>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="">Nomor Induk Mahasiswa</label>
                                                            <input type="text" name="NIM" class="form-control" placeholder="Nomor Induk Mahasiswa ..."/>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="">Perguruan Tinggi</label>
                                                            <select name="univ" id="" class="form-control js-example-basic-single">
                                                                <option value="">Pilih Perguruan Tinggi</option>
                                                                <option value="">Universitas Pendidikan Indonesia</option>
                                                                <option value="">Institut Teknologi Bandung</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="">Program Studi</label>
                                                            <input type="text" name="prodi" class="form-control" placeholder="Program Studi ..."/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> <input type="button" name="next" class="next action-button" value="Next Step" />
                                        </fieldset>
                                        <fieldset>
                                            <div class="form-card formpeminatan">
                                                <h6>Pilihlah 3 peminatan</h6>
                                                <!--Accordion wrapper-->
                                                <div class="accordion md-accordion" id="accordionEx" role="tablist" aria-multiselectable="true">

                                                    <!-- Accordion card -->
                                                    <div class="card peminatan">
                                                
                                                        <!-- Card header -->
                                                        <div class="card-header" role="tab" id="headingOne1">
                                                            <a data-toggle="collapse" data-parent="#accordionEx" href="#collapseOne1" aria-expanded="true"
                                                            aria-controls="collapseOne1">
                                                            <div class="row">
                                                                <div class="col-md-8">Hukum</div>
                                                                <div class="col-md-4"><i style="float: right;" class="fa fa-angle-down rotate-icon"></i></div>
                                                            </div>
                                                            </a>
                                                        </div>
                                                    
                                                        <!-- Card body -->
                                                        <div id="collapseOne1" class="collapse show minat" role="tabpanel" aria-labelledby="headingOne1"
                                                            data-parent="#accordionEx">
                                                            <div class="card-body">
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <input type="checkbox" name="minat" id="">
                                                                        <label for="">Nama Peminatan</label>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <input type="checkbox" name="minat" id="">
                                                                        <label for="">Nama Peminatan</label>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <input type="checkbox" name="minat" id="">
                                                                        <label for="">Nama Peminatan</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                
                                                    </div>
                                                    <!-- Accordion card -->
                                                    <br>
                                                    <!-- Accordion card -->
                                                    <div class="card peminatan">
                                                
                                                        <!-- Card header -->
                                                        <div class="card-header" role="tab" id="headingOne1">
                                                            <a data-toggle="collapse" data-parent="#accordionEx" href="#collapseOne2" aria-expanded="true"
                                                            aria-controls="collapseOne2">
                                                            <div class="row">
                                                                <div class="col-md-8">Teknologi</div>
                                                                <div class="col-md-4"><i style="float: right;" class="fa fa-angle-down rotate-icon"></i></div>
                                                            </div>
                                                            </a>
                                                        </div>
                                                    
                                                        <!-- Card body -->
                                                        <div id="collapseOne2" class="collapse minat" role="tabpanel" aria-labelledby="headingOne1"
                                                            data-parent="#accordionEx">
                                                            <div class="card-body">
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <input type="checkbox" name="minat" id="">
                                                                        <label for="">Nama Peminatan</label>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <input type="checkbox" name="minat" id="">
                                                                        <label for="">Nama Peminatan</label>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <input type="checkbox" name="minat" id="">
                                                                        <label for="">Nama Peminatan</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                
                                                    </div>
                                                    <!-- Accordion card -->
                                                    <br>
                                                    <!-- Accordion card -->
                                                    <div class="card peminatan">
                                                
                                                        <!-- Card header -->
                                                        <div class="card-header" role="tab" id="headingOne1">
                                                            <a data-toggle="collapse" data-parent="#accordionEx" href="#collapseOne3" aria-expanded="true"
                                                            aria-controls="collapseOne3">
                                                            <div class="row">
                                                                <div class="col-md-8">Teknologi</div>
                                                                <div class="col-md-4"><i style="float: right;" class="fa fa-angle-down rotate-icon"></i></div>
                                                            </div>
                                                            </a>
                                                        </div>
                                                    
                                                        <!-- Card body -->
                                                        <div id="collapseOne3" class="collapse minat" role="tabpanel" aria-labelledby="headingOne1"
                                                            data-parent="#accordionEx">
                                                            <div class="card-body">
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <input type="checkbox" name="minat" id="">
                                                                        <label for="">Nama Peminatan</label>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <input type="checkbox" name="minat" id="">
                                                                        <label for="">Nama Peminatan</label>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <input type="checkbox" name="minat" id="">
                                                                        <label for="">Nama Peminatan</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                
                                                    </div>
                                                    <!-- Accordion card -->
                                                    <br>
                                                    <!-- Accordion card -->
                                                    <div class="card peminatan">
                                                
                                                        <!-- Card header -->
                                                        <div class="card-header" role="tab" id="headingOne1">
                                                            <a data-toggle="collapse" data-parent="#accordionEx" href="#collapseOne4" aria-expanded="true"
                                                            aria-controls="collapseOne4">
                                                            <div class="row">
                                                                <div class="col-md-8">Teknologi</div>
                                                                <div class="col-md-4"><i style="float: right;" class="fa fa-angle-down rotate-icon"></i></div>
                                                            </div>
                                                            </a>
                                                        </div>
                                                    
                                                        <!-- Card body -->
                                                        <div id="collapseOne4" class="collapse minat" role="tabpanel" aria-labelledby="headingOne1"
                                                            data-parent="#accordionEx">
                                                            <div class="card-body">
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <input type="checkbox" name="minat" id="">
                                                                        <label for="">Nama Peminatan</label>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <input type="checkbox" name="minat" id="">
                                                                        <label for="">Nama Peminatan</label>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <input type="checkbox" name="minat" id="">
                                                                        <label for="">Nama Peminatan</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                
                                                    </div>
                                                    <!-- Accordion card -->
                                                
                                                </div>
                                                <!-- Accordion wrapper -->
                                            </div>
                                            <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                                            <input type="button" name="next" class="next action-button" value="Next Step" />
                                        </fieldset>
                                        <fieldset>
                                            <div class="form-card">
                                                <h2 class="fs-title text-center">Selesai !</h2> <br><br>
                                                <div class="row justify-content-center">
                                                    <div class="col-3"> <img src="https://img.icons8.com/color/96/000000/ok--v2.png" class="fit-image"> </div>
                                                </div> <br><br>
                                                <div class="row justify-content-center">
                                                    <div class="col-7 text-center">
                                                        <h5>Anda telah mengisi seluruh pelengkapan data Mahasiswa</h5>
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                                            <input type="submit" name="submit" class="action-success" value="Submit" />
                                        </fieldset>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </body>
    </html>