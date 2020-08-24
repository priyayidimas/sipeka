<!doctype html>
    <html>
        <head>
            <meta charset='utf-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1'>
            <title>Pelengkapan Biodata Dosen</title>
            <link href='https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css' rel='stylesheet'>
            <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css' rel='stylesheet'>
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
            <link rel="stylesheet" href="/assets/css/biodatadsn.css">
            <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />

            <script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
            <script type='text/javascript' src='https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js'></script>
            <script type='text/javascript' src='https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js'></script>
            <script src="/assets/js/biodata.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
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
                                    <h2><strong>Pelengkapan Data Dosen</strong></h2>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 mx-0">
                                    <form id="msform">
                                        <!-- progressbar -->
                                        <ul id="progressbar">
                                            <li class="active" id="account"><strong>Biodata</strong></li>
                                            <li id="confirm"><strong>Selesai</strong></li>
                                        </ul> <!-- fieldsets -->
                                        <fieldset>
                                            <div class="form-card">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="">Nama Dosen</label>
                                                            <input type="text" name="namadsn" class="form-control" placeholder="Nama Dosen"/>
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
                                                            <label for="">NIDN</label>
                                                            <input type="text" name="nidn" class="form-control" placeholder="Nomor Induk Dosen Nasional ..."/>
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
                                                            <label for="">Home Base Program Studi</label>
                                                            <input type="text" name="prodi" class="form-control" placeholder="Program Studi ..."/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
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
