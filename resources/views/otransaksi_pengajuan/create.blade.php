@extends('layouts.main')

<style>
    .card {}

    .form-control:focus {
        background-color: #E0FFFF !important;
    }

    .block {
	display: block;
	width: 20%;
	border: none;
	background-color: #04AA6D;
	color: rgb(51, 161, 29);
	padding: 14px 28px;
	font-size: 16px;
	cursor: pointer;
	text-align: center;
	}
</style>

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Tambah Borongan xxxx</h1>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/pengajuan">Transaksi Borongan xxx</a></li>
                            <li class="breadcrumb-item active">Add</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="store" id="entri" method="POST">
                                    @csrf
                                    {{-- <ul class="nav nav-tabs">
                            <li class="nav-item active">
                                <a class="nav-link active" href="#data" data-toggle="tab">Data</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#dokumen" data-toggle="tab">Dokumen</a>
                            </li>
                        </ul> --}}

                                    <div class="tab-content mt-3">
                                        <div class="form-group row">
                                            <div class="col-md-2">
                                                <label for="NO_BUKTI" class="form-label">No Bukti</label>
                                            </div>
                                            <div class="col-md-2">
                                                <input type="text" class="form-control NO_BUKTI" id="NO_BUKTI"
                                                    name="NO_BUKTI" placeholder="Masukkan Nomor Bukti" value="+"
                                                    readonly>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-md-2">
                                                <label for="TGL" class="form-label">Tgl</label>
                                            </div>
                                            <div class="col-md-2">
                                                <input class="form-control date" id="TGL" name="TGL"
                                                    data-date-format="dd-mm-yyyy" type="text" autocomplete="off"
                                                    value="{{ now()->format('d-m-Y') }}">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-md-1">
                                            </div>
                                            <div class="col-md-2">
                                                <a type="button" class="btn btn-secondary btn-center"href="#">
                                                    <span style="color: black; font-weight: bold;"><i class="fa fa-upload"></i> DIREKTUR</span>
                                                </a>
                                            </div>
                                            <div class="col-md-2">
                                                <a type="button" class="btn btn-secondary btn-center"href="#">
                                                    <span style="color: black; font-weight: bold;"><i class="fa fa-upload"></i> PAYROLL</span>
                                                </a>
                                            </div>
                                            <div class="col-md-2">
                                                <a type="button" class="btn btn-secondary btn-center"href="#">
                                                    <span style="color: black; font-weight: bold;"><i class="fa fa-upload"></i> FM</span>
                                                </a>
                                            </div>
                                            <div class="col-md-2">
                                                <a type="button" class="btn btn-secondary btn-center"href="#">
                                                    <span style="color: black; font-weight: bold;"><i class="fa fa-upload"></i> PRODUKSI</span>
                                                </a>
                                            </div>
                                            <div class="col-md-2">
                                                <a type="button" class="btn btn-secondary btn-center"href="#">
                                                    <span style="color: black; font-weight: bold;"><i class="fa fa-upload"></i> IE</span>
                                                </a>
                                            </div>
                                        </div>

                                        <hr style="margin-top: 30px; margin-buttom: 30px">

                                        <table id="datatable" class="table table-striped table-border">
                                            <thead class="texxt-center">
                                                <tr>
                                                    <th width="50px">No.</th>
                                                <th width="200px">
													<label style="color:red;font-size:20px">* </label>
													<label for="ARTICLE" class="form-label">NAMA ARTICLE</label>
												</th>
												<th width="200px">CUTTING</th>
												<th width="200px">PRINT EMBOSSS</th>
												<th width="200px">PSP</th>
												<th width="200px">JUKI</th>
												<th width="200px">SEWING</th>
												<th width="200px">INJECT/INSERT</th>
												<th width="200px">PACKING</th>
												<th width="200px">PSP ASSEMB</th>
												<th width="200px">ASSEMBLING</th>
												<th width="200px">STOCKFIT</th>
												<th width="200px">INJECT/C.SOL</th>
												<th width="200px">PSP CAT SPRAY</th>
												<th width="200px">CAT SPRAY/KUAS</th>
												<th width="200px">PSP FLOCKING</th>
												<th width="200px">FLOCKING</th>
												<th width="200px">ASS.PACKING</th>
												<th width="200px">COMPOUND</th>
												<th width="200px">GLG. AVALAN</th>
												<th width="200px">INJECT</th>
												<th width="200px">PLONG</th>
												<th width="200px">SABLON</th>
												<th width="200px">JAHIT</th>
												<th width="200px">CAT SPRAY</th>
												<th width="200px">MICRO</th>
												<th width="200px">BORDIR</th>
												<th width="200px">SABLON PRESS</th>
												<th width="200px">PERS.JAHIT</th>
												<th width="200px">PERS.ASS</th>
												<th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <input name="REC[]" id="REC0" type="text" value="1"
                                                            class="form-control REC" onkeypress="return tabE(this,event)"
                                                            readonly>
                                                    </td>
													<td>
                                                        <input name="ARTICLE[]" id="ARTICLE0" type="text"
                                                            class="form-control ARTICLE " required>
                                                    </td>
                                                    <td><input name="CUTTING[]" onclick="select()" onkeyup="hitung()"
															id="CUTTING0" type="text" value="0"
															style="text-align: right"
															class="form-control CUTTING text-primary"></td>
													<td><input name="EMBOS[]" onclick="select()" onkeyup="hitung()"
															id="EMBOS0" type="text" value="0"
															style="text-align: right " 
															class="form-control EMBOSS text-primary"></td>
													<td><input name="PSP[]" onclick="select()" onkeyup="hitung()"
															id="PSP0" type="text" value="0"
															style="text-align: right " 
															class="form-control PSP text-primary"></td>
													<td><input name="JUKI[]" onclick="select()" onkeyup="hitung()"
															id="JUKI0" type="text" value="0"
															style="text-align: right " 
															class="form-control JUKI text-primary"></td>
													<td><input name="JAHIT[]" onclick="select()" onkeyup="hitung()"
															id="JAHIT0" type="text" value="0"
															style="text-align: right " 
															class="form-control JAHIT text-primary"></td>
													<td><input name="INJECT[]" onclick="select()" onkeyup="hitung()"
															id="INJECT0" type="text" value="0"
															style="text-align: right " 
															class="form-control INJECT text-primary"></td>
													<td><input name="PACKING[]" onclick="select()" onkeyup="hitung()"
															id="PACKING0" type="text" value="0"
															style="text-align: right " 
															class="form-control PACKING text-primary"></td>
													<td><input name="PSP_ASSB[]" onclick="select()" onkeyup="hitung()"
															id="PSP_ASSB0" type="text" value="0"
															style="text-align: right " 
															class="form-control PSP_ASSB text-primary"></td>
													<td><input name="ASSEMBLING[]" onclick="select()" onkeyup="hitung()"
															id="ASSEMBLING0" type="text" value="0"
															style="text-align: right " 
															class="form-control ASSEMBLING text-primary"></td>
													<td><input name="STOCKFIT[]" onclick="select()" onkeyup="hitung()"
															id="STOCKFIT0" type="text" value="0"
															style="text-align: right " 
															class="form-control STOCKFIT text-primary"></td>
													<td><input name="INJECT[]" onclick="select()" onkeyup="hitung()"
															id="INJECT0" type="text" value="0"
															style="text-align: right " 
															class="form-control INJECT text-primary"></td>
													<td><input name="PSP_CAT[]" onclick="select()" onkeyup="hitung()"
															id="PSP_CAT0" type="text" value="0"
															style="text-align: right " 
															class="form-control PSP_CAT text-primary"></td>
													<td><input name="CAT_SPRAY[]" onclick="select()" onkeyup="hitung()"
															id="CAT_SPRAY0" type="text" value="0"
															style="text-align: right " 
															class="form-control CAT_SPRAY text-primary"></td>
													<td><input name="PSP_FLOCK[]" onclick="select()" onkeyup="hitung()"
															id="PSP_FLOCK0" type="text" value="0"
															style="text-align: right " 
															class="form-control PSP_FLOCK text-primary"></td>
													<td><input name="FLOCKING[]" onclick="select()" onkeyup="hitung()"
															id="FLOCKING0" type="text" value="0"
															style="text-align: right " 
															class="form-control FLOCKING text-primary"></td>
													<td><input name="ASSB_PACKING[]" onclick="select()" onkeyup="hitung()"
															id="ASSB_PACKING0" type="text" value="0"
															style="text-align: right " 
															class="form-control ASSB_PACKING text-primary"></td>
													<td><input name="COMP[]" onclick="select()" onkeyup="hitung()"
															id="COMP0" type="text" value="0"
															style="text-align: right " 
															class="form-control COMP text-primary"></td>
													<td><input name="GILING[]" onclick="select()" onkeyup="hitung()"
															id="GILING0" type="text" value="0"
															style="text-align: right " 
															class="form-control GILING text-primary"></td>
													<td><input name="INJECT[]" onclick="select()" onkeyup="hitung()"
															id="INJECT0" type="text" value="0"
															style="text-align: right " 
															class="form-control INJECT text-primary"></td>
													<td><input name="CUTTING[]" onclick="select()" onkeyup="hitung()"
															id="CUTTING0" type="text" value="0"
															style="text-align: right " 
															class="form-control CUTTING text-primary"></td>
													<td><input name="EMBOS[]" onclick="select()" onkeyup="hitung()"
															id="EMBOS0" type="text" value="0"
															style="text-align: right " 
															class="form-control EMBOS text-primary"></td>
													<td><input name="JAHIT[]" onclick="select()" onkeyup="hitung()"
															id="JAHIT0" type="text" value="0"
															style="text-align: right " 
															class="form-control JAHIT text-primary"></td>
													<td><input name="CAT_SPRAY[]" onclick="select()" onkeyup="hitung()"
															id="CAT_SPRAY0" type="text" value="0"
															style="text-align: right " 
															class="form-control CAT_SPRAY text-primary"></td>
													<td><input name="MICRO[]" onclick="select()" onkeyup="hitung()"
															id="MICRO0" type="text" value="0"
															style="text-align: right " 
															class="form-control MICRO text-primary"></td>
													<td><input name="BORDIR[]" onclick="select()" onkeyup="hitung()"
															id="BORDIR0" type="text" value="0"
															style="text-align: right " 
															class="form-control BORDIR text-primary"></td>
													<td><input name="EMBOS[]" onclick="select()" onkeyup="hitung()"
															id="EMBOS0" type="text" value="0"
															style="text-align: right " 
															class="form-control EMBOS text-primary"></td>
													<td><input name="PSP[]" onclick="select()" onkeyup="hitung()"
															id="PSP0" type="text" value="0"
															style="text-align: right " 
															class="form-control PSP text-primary"></td>
													<td><input name="PSP_ASSB[]" onclick="select()" onkeyup="hitung()"
															id="PSP_ASSB0" type="text" value="0"
															style="text-align: right " 
															class="form-control PSP_ASSB text-primary"></td>
                                                    <!-- <td>
                                                        <input name="gambar1[]" id="gambar10" type="text"
                                                            class="form-control gambar1 " required>
                                                    </td>
                                                    <td>
                                                        <input name="pdf1[]" id="pdf10" type="text"
                                                            class="form-control pdf1 " required>
                                                    </td>
                                                    <td>
                                                        <input name="USRNM[]" id="USRNM0" type="text"
                                                            class="form-control USRNM " required>
                                                    </td>
                                                    <td>
                                                        <input name="E_TGL[]" id="E_TGL0" type="text" class="date form-control text_input" data-date-format="dd-mm-yyyy" value="<?php if (isset($_POST["tampilkan"])) {
                                                                                                                                                                                    } else echo date('d-m-Y'); ?>" onclick="select()">
                                                    </td>
                                                    <td>
                                                        <input name="E_PC[]" id="E_PC0" type="text"
                                                            class="form-control E_PC " required>
                                                    </td>
                                                    <td>
                                                        <input name="tahun[]" id="tahun0" type="text"
                                                            class="form-control tahun " required>
                                                    </td> -->
													<td>
                                                        <button type="button"
                                                            class="btn btn-sm btn-circle btn-outline-danger btn-delete"
                                                            onclick="">
                                                            <i class="fa fa-fw fa-trash"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            <tfoot>
												<tr>
                                                <td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												</tr>
                                            </tfoot>
                                        </table>
                                        <div class="col-md-2 row">
                                            <button type="button" onclick="tambah()" class="btn btn-sm btn-success"><i
                                                    class="fas fa-plus fa-sm md-3"></i> </button>
                                        </div>
										
										<div class="form-group row">
										</div>
										
										<div class="form-group row">
                                            <div class="col-md-1">
                                                <label class="form-label">Keterangan</label>
                                            </div>
											<div class="col-md-5">
												<input type="text" class="form-control ket1" id="ket1" name="ket1" placeholder="">
											</div>
											<div class="col-md-5">
												<input type="text" class="form-control ket6" id="ket6" name="ket6" placeholder="">
											</div>
										</div>
										
										<div class="form-group row">
											<div class="col-md-1">
                                                <label class="form-label"></label>
                                            </div>
											<div class="col-md-5">
												<input type="text" class="form-control ket2" id="ket2" name="ket2" placeholder="">
											</div>
											<div class="col-md-5">
												<input type="text" class="form-control ket7" id="ket7" name="ket7" placeholder="">
											</div>
										</div>
										
										<div class="form-group row">
											<div class="col-md-1">
                                                <label class="form-label"></label>
                                            </div>
											<div class="col-md-5">
												<input type="text" class="form-control ket3" id="ket3" name="ket3" placeholder="">
											</div>
											<div class="col-md-5">
												<input type="text" class="form-control ket8" id="ket8" name="ket8" placeholder="">
											</div>
										</div>
										
										<div class="form-group row">
											<div class="col-md-1">
                                                <label class="form-label"></label>
                                            </div>
											<div class="col-md-5">
												<input type="text" class="form-control ket4" id="ket4" name="ket4" placeholder="">
											</div>
											<div class="col-md-5">
												<input type="text" class="form-control ket9" id="ket9" name="ket9" placeholder="">
											</div>
										</div>
										
										<div class="form-group row">
											<div class="col-md-1">
                                                <label class="form-label"></label>
                                            </div>
											<div class="col-md-5">
												<input type="text" class="form-control ket5" id="ket5" name="ket5" placeholder="">
											</div>
											<div class="col-md-5">
												<input type="text" class="form-control ket10" id="ket10" name="ket10" placeholder="">
											</div>
										</div>
                                    </div>

                                    {{-- <button type="button"  class="btn btn-success"><i
                                            class="fa fa-save"></i> Save</button> --}}
                                    <div class="mt-3">
                                        <div class="btn btn-primary ld-ext-right simpan" onclick="simpan()">
                                            <!-- <div class="ld">
                                                <img src="{{ asset('gif/loading1.gif') }}" />
                                            </div> -->
                                            Save
                                        </div>
                                        <a type="button" href="javascript:javascript:history.go(-1)"
                                            class="btn btn-danger">Cancel</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->



        <div class="modal fade" id="browseAccountModal" tabindex="-1" role="dialog"
            aria-labelledby="browseAccountModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="browseAccountModalLabel">Cari Account</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-stripped table-bordered" id="table-baccount">
                            <thead>
                                <tr>
                                    <th>Account#</th>
                                    <th>Nama</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade" id="browseAccount1Modal" tabindex="-1" role="dialog"
            aria-labelledby="browseAccount1ModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="browseAccount1ModalLabel">Cari Account</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-stripped table-bordered" id="table-baccount1">
                            <thead>
                                <tr>
                                    <th>Account#</th>
                                    <th>Nama</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        
 
        <div class="modal fade" id="browsePegawaiModal" tabindex="-1" role="dialog"
            aria-labelledby="browsePegawaiModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="browsePegawaiModalLabel">Cari Pegawai</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-stripped table-bordered" id="table-bpegawai">
                            <thead>
                                <tr>
                                    <th>Pegawai#</th>
                                    <th>Nama</th>
                                    <th>Pinjam</th>
                                    <th>Bayar</th>
                                    <th>Sisa</th>                                    
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>



		<div class="modal fade" id="browseTransModal" tabindex="-1" role="dialog"
            aria-labelledby="browseTransModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl"  role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="browseTransModalLabel">Cari Transaksi</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-stripped table-bordered" id="table-btrans">
                            <thead>
                                <tr>
                                    <th>Bukti#</th>
                                    <th>Tgl</th>
                                    <th>Kode</th>
                                    <th>Nama</th>
                                    <th>Bayar</th>                                    
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
		





		
    @endsection

    @section('footer-scripts')
        <!-- TAMBAH 1 -->

<script src="{{ asset('js/autoNumerics/autoNumeric.min.js') }}"></script>
 <!--       <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script> -->
<script src="{{asset('foxie_js_css/bootstrap.bundle.min.js')}}"></script>

        <script>
            var idrow = 1;
	    var baris = 1;
            function numberWithCommas(x) {
                return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            }

            // TAMBAH HITUNG
            $(document).ready(function() {

                $("#TJUMLAH").autoNumeric('init', {
                    aSign: '<?php echo ''; ?>',
                    vMin: '-999999999.99'
                });

                jumlahdata = 100;
                for (i = 0; i <= jumlahdata; i++) {
                    $("#JUMLAH" + i.toString()).autoNumeric('init', {
                        aSign: '<?php echo ''; ?>',
                        vMin: '-999999999.99'
                    });
                }
                $('body').on('click', '.btn-delete', function() {
                    var val = $(this).parents("tr").remove();
                    baris--;
                    nomor();
                });
                $(".date").datepicker({
                    'dateFormat': 'dd-mm-yy',
                })


                ///////////////////////////////////////////////////////////////////////

                ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////		


                //CHOOSE Bacno
                var dTableBAccount1;
                loadDataBAccount1 = function() {
                    $.ajax({
                        type: 'GET',
                        url: '{{ url('account/browsecash') }}',
                        success: function(response) {
                            resp = response;
                            if (dTableBAccount1) {
                                dTableBAccount1.clear();
                            }
                            for (i = 0; i < resp.length; i++) {

                                dTableBAccount1.row.add([
                                    '<a href="javascript:void(0);" onclick="chooseAccount1(\'' +
                                    resp[i].ACNO + '\',\'' + resp[i].NAMA + '\')">' + resp[i]
                                    .ACNO + '</a>',
                                    resp[i].NAMA,
                                ]);
                            }
                            dTableBAccount1.draw();
                        }
                    });
                }

                dTableBAccount1 = $("#table-baccount1").DataTable({

                });

                browseAccount1 = function() {
                    loadDataBAccount1();
                    $("#browseAccount1Modal").modal("show");
                }

                chooseAccount1 = function(ACNO, NAMA) {
                    $("#BACNO").val(ACNO);
                    $("#BNAMA").val(NAMA);
                    $("#browseAccount1Modal").modal("hide");
                }

                $("#BACNO").keypress(function(e) {
                    if (e.keyCode == 46) {
                        e.preventDefault();
                        browseAccount1();
                    }
                });


 ///////////////////////////               

                var dTableBAccount;
                var rowidAccount;
                loadDataBAccount = function() {
                    $.ajax({
                        type: 'GET',
                        url: "{{ url('account/browse') }}",
                        success: function(response) {
                            resp = response;
                            if (dTableBAccount) {
                                dTableBAccount.clear();
                            }
                            for (i = 0; i < resp.length; i++) {

                                dTableBAccount.row.add([
                                    '<a href="javascript:void(0);" onclick="chooseAccount(\'' +
                                    resp[i].ACNO + '\',\'' + resp[i].NAMA + '\')">' + resp[i]
                                    .ACNO + '</a>',
                                    resp[i].NAMA,
                                ]);
                            }
                            dTableBAccount.draw();
                        }
                    });
                }

                dTableBAccount = $("#table-baccount").DataTable({

                });

                browseAccount = function(rid) {
                    rowidAccount = rid;
                    loadDataBAccount();
                    $("#browseAccountModal").modal("show");
                }

                chooseAccount = function(ACNO, NAMA) {
                    $("#ACNO" + rowidAccount).val(ACNO);
                    $("#NACNO" + rowidAccount).val(NAMA);
					$("#NACNO_KET").val(NAMA);		
					$("#ACNO_KET").val(ACNO);					
                    $("#browseAccountModal").modal("hide");
                }


                $("#ACNO0").keypress(function(e) {
                    if (e.keyCode == 46) {
                        e.preventDefault();
                        browseAccount(0);
                    }
                });
  
///////////////////////////////////////////////////////////////////////

	var dTablePegawai;
		var rowidPegawai;
		loadDataBPegawai = function(){
			$.ajax(
			{
				type: 'GET',    
				url: "{{url('pegawai/browse')}}",
				success: function( response )
				{
					resp = response;
					if(dTableBPegawai){
						dTableBPegawai.clear();
					}
					for(i=0; i<resp.length; i++){
						
						dTableBPegawai.row.add([
							'<a href="javascript:void(0);" onclick="choosePegawai(\''+resp[i].KODEP+'\',\''+resp[i].NAMAP+'\' ,\''+resp[i].TOTAL+'\', \''+resp[i].BAYAR+'\' ,\''+resp[i].SISA+'\' )">'+resp[i].KODEP+'</a>',
							resp[i].NAMAP,
							resp[i].TOTAL,
							resp[i].BAYAR,							
							resp[i].SISA,							
						]);
					}
					dTableBPegawai.draw();
				}
			});
		}
		
		dTableBPegawai = $("#table-bpegawai").DataTable({

			columnDefs: [
					{
                    className: "dt-right", 
					targets:  [4],
					render: $.fn.dataTable.render.number( ',', '.', 0, '' )
					}
			],
					
		});
		
		browsePegawai = function(rid){
			rowidPegawai = rid;
			loadDataBPegawai();
			$("#browsePegawaiModal").modal("show");
		}
		
		choosePegawai = function(kodep,namap){
			$("#KODEP"+rowidPegawai).val(kodep);
			$("#NAMAP"+rowidPegawai).val(namap);
            $("#KODEP_KET").val(kodep);		
            $("#NAMAP_KET").val(namap);				
			$("#browsePegawaiModal").modal("hide");
		}
		
		
		$("#KODEP0").keypress(function(e){
			if(e.keyCode == 46){
				e.preventDefault();
				browsePegawai(0);
			}
		}); 		


////////////////////////////////////////////////////////////////////////		
                


	var dTableTrans;
		var rowidTrans;
		loadDataBTrans = function(){
			$.ajax(
			{
				type: 'GET',    
				url: "{{url('account/browsetrans')}}",
				data: 
				{
                    ACNO : $("#ACNO"+rowidTrans).val(),					   
				},
				success: function( response )
				{
					resp = response;
					if(dTableBTrans){
						dTableBTrans.clear();
					}
					for(i=0; i<resp.length; i++){
						
						dTableBTrans.row.add([
							'<a href="javascript:void(0);" onclick="chooseTrans(\''+resp[i].NO_BUKTI+'\',\''+resp[i].TGL+'\' ,\''+resp[i].KODE+'\', \''+resp[i].NAMA+'\' ,\''+resp[i].BAYAR+'\' ,\''+resp[i].ACNO+'\' ,\''+resp[i].NACNO+'\' ,\''+resp[i].URAIAN+'\' )">'+resp[i].NO_BUKTI+'</a>',
							resp[i].TGL,
							resp[i].KODE,
							resp[i].NAMA,
							//Intl.NumberFormat('en-US').format(resp[i].TOTAL),
						//	'<label for="pilihTotal" id="pilihTotal'+i+'" value="'+resp[i].TOTAL+'">'+Intl.NumberFormat('en-US').format(resp[i].TOTAL)+'</label>',
							Intl.NumberFormat('en-US').format(resp[i].BAYAR),
							//Intl.NumberFormat('en-US').format(resp[i].SISA),	
						//	'<label for="pilihSisa" id="pilihSisa'+i+'" value="'+resp[i].SISA+'">'+Intl.NumberFormat('en-US').format(resp[i].SISA)+'</label>',
						]);
					}
					dTableBTrans.draw();
				}
			});
		}
		
		dTableBTrans = $("#table-btrans").DataTable({


					
		});
		
		browseTrans = function(rid){
			rowidTrans = rid;
			loadDataBTrans();
			$("#browseTransModal").modal("show");
		}
		
		chooseTrans = function(NO_BUKTI, TGL, KODE, NAMA, BAYAR,  ACNO, NACNO, URAIAN ){
			$("#NO_TRANS"+rowidTrans).val(NO_BUKTI);
			$("#JUMLAH"+rowidTrans).val(BAYAR);
			$("#ACNO"+rowidTrans).val(ACNO);
			$("#NACNO"+rowidTrans).val(NACNO);
			$("#URAIAN"+rowidTrans).val(URAIAN);
		    $("#NACNO_KET").val(NACNO);		
			$("#ACNO_KET").val(ACNO);				
			$("#browseTransModal").modal("hide");
		}
		
		
		$("#NO_TRANS0").keypress(function(e){
			if(e.keyCode == 46){
				e.preventDefault();
				browseTrans(0);
			}
		}); 	
		

///////////////////////////////////////////////////////////




//////////////////////////////////////////////////////////////////////////           
	});


            //////////////////////////////////////////////////////////////////
	
	function cekDetail(){
		var cekAcno = '';
		$(".ACNO").each(function() {
			
			let z = $(this).closest('tr');
			var ACNOX = z.find('.ACNO').val();
			
			if( ACNOX =="" )
			{
					cekAcno = '1';
					
			}	
		});
		
		return cekAcno;
	}




/////////////////////////////////////////////


            function simpan() {

                hitung();

                var tgl = $('#TGL').val();
                var bulanPer = {{ session()->get('periode')['bulan'] }};
                var tahunPer = {{ session()->get('periode')['tahun'] }};

                var check = '0';

				if (cekDetail())
				{	
					check = '1';
					alert("Ada Akun# Kosong Didetail.");
				}
			
                if ($('#BACNO').val() == '') {
                    check = '1';
                    alert("Kas# Harus diisi.");
                }

                if (tgl.substring(3, 5) != bulanPer) {

                    check = '1';
                    alert("Bulan tidak sama dengan Periode");
                }

                if (tgl.substring(tgl.length - 4) != tahunPer) {
                    check = '1';
                    alert("Tahun tidak sama dengan Periode");

                }

                if (check == '0') {
                    $(".simpan").addClass("running");
                    document.getElementById("entri").submit();
                }
            }


            function nomor() {
                var i = 1;
                $(".REC").each(function() {
                    $(this).val(i++);
                });
                hitung();
            }

            function hitung() {
                var TJUMLAH = 0;


                $(".JUMLAH").each(function() {
                    var val = parseFloat($(this).val().replace(/,/g, ''));
                    if (isNaN(val)) val = 0;
                    TJUMLAH += val;
                });

                if (isNaN(TJUMLAH)) TJUMLAH = 0;

                $('#TJUMLAH').val(numberWithCommas(TJUMLAH));
                $("#TJUMLAH").autoNumeric('update');

            }

            function tambah() {

                var x = document.getElementById('datatable').insertRow(baris + 1);
                var td1 = x.insertCell(0);
                var td2 = x.insertCell(1);
                var td3 = x.insertCell(2);
                var td4 = x.insertCell(3);
                var td5 = x.insertCell(4);
                var td6 = x.insertCell(5);
                var td7 = x.insertCell(6);
                var td8 = x.insertCell(7);
                var td9 = x.insertCell(8);
                var td10 = x.insertCell(9);
                var td11 = x.insertCell(10);
                var td12 = x.insertCell(11);
                var td13 = x.insertCell(12);
                var td14 = x.insertCell(13);
                var td15 = x.insertCell(14);
                var td16 = x.insertCell(15);
                var td17 = x.insertCell(16);
                var td18 = x.insertCell(17);
                var td19 = x.insertCell(18);
                var td20 = x.insertCell(19);
                var td21 = x.insertCell(20);
                var td22 = x.insertCell(21);
                var td23 = x.insertCell(22);
                var td24 = x.insertCell(23);
                var td25 = x.insertCell(24);
                var td26 = x.insertCell(25);
                var td27 = x.insertCell(26);
                var td28 = x.insertCell(27);
                var td29 = x.insertCell(28);
                var td30 = x.insertCell(29);
                var td31 = x.insertCell(30);
                

                td1.innerHTML = "<input name='REC[]'    id=REC" + idrow +
                    " type='text' class='REC form-control '  onkeypress='return tabE(this,event)' readonly>";
				td2.innerHTML = "<input name='ARTICLE[]'   id=ARTICLE" + idrow +
                    " type='text' class='form-control  ARTICLE' required>";
                td3.innerHTML = "<input name='CUTTING[]' onclick='select()' onkeyup='hitung()' value='0' id=CUTTING" + idrow +
                    " type='text' style='text-align: right' class='form-control CUTTING  text-primary' required>";
                td4.innerHTML = "<input name='EMBOS[]' onclick='select()' onkeyup='hitung()' value='0' id=EMBOS" + idrow +
                    " type='text' style='text-align: right' class='form-control EMBOS  text-primary' required>";
                td5.innerHTML = "<input name='PSP[]' onclick='select()' onkeyup='hitung()' value='0' id=PSP" + idrow +
                    " type='text' style='text-align: right' class='form-control PSP  text-primary' required>";
                td6.innerHTML = "<input name='JUKI[]' onclick='select()' onkeyup='hitung()' value='0' id=JUKI" + idrow +
                    " type='text' style='text-align: right' class='form-control JUKI  text-primary' required>";
                td7.innerHTML = "<input name='JAHIT[]' onclick='select()' onkeyup='hitung()' value='0' id=JAHIT" + idrow +
                    " type='text' style='text-align: right' class='form-control JAHIT  text-primary' required>";
                td8.innerHTML = "<input name='INJECT[]' onclick='select()' onkeyup='hitung()' value='0' id=INJECT" + idrow +
                    " type='text' style='text-align: right' class='form-control INJECT  text-primary' required>";
                td9.innerHTML = "<input name='PACKING[]' onclick='select()' onkeyup='hitung()' value='0' id=PACKING" + idrow +
                    " type='text' style='text-align: right' class='form-control PACKING  text-primary' required>";
                td10.innerHTML = "<input name='PSP_ASSB[]' onclick='select()' onkeyup='hitung()' value='0' id=PSP_ASSB" + idrow +
                    " type='text' style='text-align: right' class='form-control PSP_ASSB  text-primary' required>";
                td11.innerHTML = "<input name='ASSEMBLING[]' onclick='select()' onkeyup='hitung()' value='0' id=ASSEMBLING" + idrow +
                    " type='text' style='text-align: right' class='form-control ASSEMBLING  text-primary' required>";
                td12.innerHTML = "<input name='STOCKFIT[]' onclick='select()' onkeyup='hitung()' value='0' id=STOCKFIT" + idrow +
                    " type='text' style='text-align: right' class='form-control STOCKFIT  text-primary' required>";
                td13.innerHTML = "<input name='INJECT[]' onclick='select()' onkeyup='hitung()' value='0' id=INJECT" + idrow +
                    " type='text' style='text-align: right' class='form-control INJECT  text-primary' required>";
                td14.innerHTML = "<input name='PSP_CAT[]' onclick='select()' onkeyup='hitung()' value='0' id=PSP_CAT" + idrow +
                    " type='text' style='text-align: right' class='form-control PSP_CAT  text-primary' required>";
                td15.innerHTML = "<input name='CAT_SPRAY[]' onclick='select()' onkeyup='hitung()' value='0' id=CAT_SPRAY" + idrow +
                    " type='text' style='text-align: right' class='form-control CAT_SPRAY  text-primary' required>";
                td16.innerHTML = "<input name='PSP_FLOCK[]' onclick='select()' onkeyup='hitung()' value='0' id=PSP_FLOCK" + idrow +
                    " type='text' style='text-align: right' class='form-control PSP_FLOCK  text-primary' required>";
                td17.innerHTML = "<input name='FLOCKING[]' onclick='select()' onkeyup='hitung()' value='0' id=FLOCKING" + idrow +
                    " type='text' style='text-align: right' class='form-control FLOCKING  text-primary' required>";
                td18.innerHTML = "<input name='ASSB_PACKING[]' onclick='select()' onkeyup='hitung()' value='0' id=ASSB_PACKING" + idrow +
                    " type='text' style='text-align: right' class='form-control ASSB_PACKING  text-primary' required>";
                td19.innerHTML = "<input name='COMP[]' onclick='select()' onkeyup='hitung()' value='0' id=COMP" + idrow +
                    " type='text' style='text-align: right' class='form-control COMP  text-primary' required>";
                td20.innerHTML = "<input name='GILING[]' onclick='select()' onkeyup='hitung()' value='0' id=GILING" + idrow +
                    " type='text' style='text-align: right' class='form-control GILING  text-primary' required>";
                td21.innerHTML = "<input name='INJECT[]' onclick='select()' onkeyup='hitung()' value='0' id=INJECT" + idrow +
                    " type='text' style='text-align: right' class='form-control INJECT  text-primary' required>";
                td22.innerHTML = "<input name='CUTTING[]' onclick='select()' onkeyup='hitung()' value='0' id=CUTTING" + idrow +
                    " type='text' style='text-align: right' class='form-control CUTTING  text-primary' required>";
                td23.innerHTML = "<input name='EMBOS[]' onclick='select()' onkeyup='hitung()' value='0' id=EMBOS" + idrow +
                    " type='text' style='text-align: right' class='form-control EMBOS  text-primary' required>";
                td24.innerHTML = "<input name='JAHIT[]' onclick='select()' onkeyup='hitung()' value='0' id=JAHIT" + idrow +
                    " type='text' style='text-align: right' class='form-control JAHIT  text-primary' required>";
                td25.innerHTML = "<input name='CAT_SPRAY[]' onclick='select()' onkeyup='hitung()' value='0' id=CAT_SPRAY" + idrow +
                    " type='text' style='text-align: right' class='form-control CAT_SPRAY  text-primary' required>";
                td26.innerHTML = "<input name='MICRO[]' onclick='select()' onkeyup='hitung()' value='0' id=MICRO" + idrow +
                    " type='text' style='text-align: right' class='form-control MICRO  text-primary' required>";
                td27.innerHTML = "<input name='BORDIR[]' onclick='select()' onkeyup='hitung()' value='0' id=BORDIR" + idrow +
                    " type='text' style='text-align: right' class='form-control BORDIR  text-primary' required>";
                td28.innerHTML = "<input name='EMBOS[]' onclick='select()' onkeyup='hitung()' value='0' id=EMBOS" + idrow +
                    " type='text' style='text-align: right' class='form-control EMBOS  text-primary' required>";
                td29.innerHTML = "<input name='PSP[]' onclick='select()' onkeyup='hitung()' value='0' id=PSP" + idrow +
                    " type='text' style='text-align: right' class='form-control PSP  text-primary' required>";
                td30.innerHTML = "<input name='PSP_ASSB[]' onclick='select()' onkeyup='hitung()' value='0' id=PSP_ASSB" + idrow +
                    " type='text' style='text-align: right' class='form-control PSP_ASSB  text-primary' required>";
                td31.innerHTML =
                    "<button type='button' class='btn btn-sm btn-circle btn-outline-danger btn-delete' onclick=''> <i class='fa fa-fw fa-trash'></i> </button>";
                    
                jumlahdata = 100;
                for (i = 0; i <= jumlahdata; i++) {
                    $("#CUTTING" + i.toString()).autoNumeric('init', {
                        aSign: '<?php echo ''; ?>',
                        vMin: '-999999999.99'
                    });
                    $("#EMBOS" + i.toString()).autoNumeric('init', {
                        aSign: '<?php echo ''; ?>',
                        vMin: '-999999999.99'
                    });
                    $("#PSP" + i.toString()).autoNumeric('init', {
                        aSign: '<?php echo ''; ?>',
                        vMin: '-999999999.99'
                    });
                    $("#JUKI" + i.toString()).autoNumeric('init', {
                        aSign: '<?php echo ''; ?>',
                        vMin: '-999999999.99'
                    });
                    $("#JAHIT" + i.toString()).autoNumeric('init', {
                        aSign: '<?php echo ''; ?>',
                        vMin: '-999999999.99'
                    });
                    $("#INJECT" + i.toString()).autoNumeric('init', {
                        aSign: '<?php echo ''; ?>',
                        vMin: '-999999999.99'
                    });
                    $("#PACKING" + i.toString()).autoNumeric('init', {
                        aSign: '<?php echo ''; ?>',
                        vMin: '-999999999.99'
                    });
                    $("#PSP_ASEMB" + i.toString()).autoNumeric('init', {
                        aSign: '<?php echo ''; ?>',
                        vMin: '-999999999.99'
                    });
                    $("#ASSEMBLING" + i.toString()).autoNumeric('init', {
                        aSign: '<?php echo ''; ?>',
                        vMin: '-999999999.99'
                    });
                    $("#STOCKFIT" + i.toString()).autoNumeric('init', {
                        aSign: '<?php echo ''; ?>',
                        vMin: '-999999999.99'
                    });
                    $("#PSP_CAT" + i.toString()).autoNumeric('init', {
                        aSign: '<?php echo ''; ?>',
                        vMin: '-999999999.99'
                    });
                    $("#CAT_SPRAY" + i.toString()).autoNumeric('init', {
                        aSign: '<?php echo ''; ?>',
                        vMin: '-999999999.99'
                    });
                    $("#PSP_FLOCK" + i.toString()).autoNumeric('init', {
                        aSign: '<?php echo ''; ?>',
                        vMin: '-999999999.99'
                    });
                    $("#FLOCKING" + i.toString()).autoNumeric('init', {
                        aSign: '<?php echo ''; ?>',
                        vMin: '-999999999.99'
                    });
                    $("#ASS_PACKING" + i.toString()).autoNumeric('init', {
                        aSign: '<?php echo ''; ?>',
                        vMin: '-999999999.99'
                    });
                    $("#COMP" + i.toString()).autoNumeric('init', {
                        aSign: '<?php echo ''; ?>',
                        vMin: '-999999999.99'
                    });
                    $("#GILING" + i.toString()).autoNumeric('init', {
                        aSign: '<?php echo ''; ?>',
                        vMin: '-999999999.99'
                    });
                    $("#CUTTING" + i.toString()).autoNumeric('init', {
                        aSign: '<?php echo ''; ?>',
                        vMin: '-999999999.99'
                    });
                    $("#MICRO" + i.toString()).autoNumeric('init', {
                        aSign: '<?php echo ''; ?>',
                        vMin: '-999999999.99'
                    });
                    $("#BORDIR" + i.toString()).autoNumeric('init', {
                        aSign: '<?php echo ''; ?>',
                        vMin: '-999999999.99'
                    });
                    $("#PSP_ASSB" + i.toString()).autoNumeric('init', {
                        aSign: '<?php echo ''; ?>',
                        vMin: '-999999999.99'
                    });
                    $("#ASSB_PACKING" + i.toString()).autoNumeric('init', {
                        aSign: '<?php echo ''; ?>',
                        vMin: '-999999999.99'
                    });
                }
		
                idrow++;
                baris++;
                nomor();
                $(".ronly").on('keydown paste', function(e) {
                    e.preventDefault();
                    e.currentTarget.blur();
                });
            }
        </script>
    @endsection
