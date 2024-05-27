@extends('layouts.main')

<style>
    .card {

    }

    .form-control:focus {
        background-color: #E0FFFF !important;
    }
</style>

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
               <h1 class="m-0">Edit Data Suplier {{$KODES}}</h1>	
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{url('/sup')}}">Master Suplier</a></li>
                <li class="breadcrumb-item active">Edit {{$KODES}}</li>
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
                    <form action="{{url('/sup/update/'.$NO_ID)}}" method="POST" id="entri">
                        @csrf
						
                        <ul class="nav nav-tabs">
                            <li class="nav-item active">
                                <a class="nav-link active" href="#suppInfo" data-toggle="tab">Supp Info</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#bankInfo" data-toggle="tab">Bank Info</a>
                            </li>
                        </ul>
        
                        <div class="tab-content mt-3">
							<div id="suppInfo" class="tab-pane active">
							
                            <div class="form-group row">
                                <div class="col-md-2">
                                    <label for="KODES" class="form-label">Kode</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control KODES" id="KODES" name="KODES"
                                    placeholder="Masukkan Kode Suplier" value="{{$KODES}}" readonly>
                                </div>                                
                            </div>

							<div class="form-group row">
                                <div class="col-md-2">
                                    <label for="NAMAS" class="form-label">Nama</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control NAMAS" id="NAMAS" name="NAMAS"
                                    placeholder="Masukkan Nama Suplier" value="{{$NAMAS}}">
                                </div>                                
                            </div>
        
                            <div class="form-group row">
                                <div class="col-md-2">
                                    <label for="ALAMAT" class="form-label">Alamat</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control ALAMAT" id="ALAMAT" name="ALAMAT"
                                    placeholder="Masukkan Alamat" value="{{$ALAMAT}}">
                                </div>
							</div>

							<div class="form-group row">
                                <div class="col-md-2">
                                    <label for="KOTA" class="form-label">Kota</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control KOTA" id="KOTA "name="KOTA"
                                    placeholder="Masukkan Kota" value="{{$KOTA}}">
                                </div>
                            </div>
        
							<div class="form-group row">
                                <div class="col-md-2">
                                    <label for="TELPON1" class="form-label">Telpon</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control TELPON1" id="TELPON1"name="TELPON1"
                                    placeholder="Masukkan Telpon" value="{{$TELPON1}}">
                                </div>
                            </div>

							<div class="form-group row">
                                <div class="col-md-2">
                                    <label for="FAX" class="form-label">Fax</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control FAX" id="FAX"name="FAX"
                                    placeholder="Masukkan Fax" value="{{$FAX}}">
                                </div>
                            </div>
 
							<div class="form-group row">
                                <div class="col-md-2">
                                    <label for="HP" class="form-label">HP</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control HP" id="HP"name="HP"
                                    placeholder="Masukkan HP" value="{{$HP}}">
                                </div>
								
							<!-- <div class="col-md-2">
									<label for="AKT" class="form-label">Aktif</label>
								</div> -->
									
                                <div class="col-md-4">
                                    <input type="checkbox" class="form-check-input" id="AKT"name="AKT"
                                    placeholder="Masukkan Aktif/Tidak" value="1" {{ ($AKT == 1) ? 'checked' : '' }}>
									<label for="AKT">Aktif</label>
                                </div> 
                            </div>

							<div class="form-group row">
                                <div class="col-md-2">
                                    <label for="KONTAK" class="form-label">Kontak</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control KONTAK" id="KONTAK"name="KONTAK"
                                    placeholder="Masukkan Kontak" value="{{$KONTAK}}">
                                </div>
                            </div>
 
							<div class="form-group row">
                                <div class="col-md-2">
                                    <label for="EMAIL" class="form-label">Email</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control EMAIL" id="EMAIL"name="EMAIL"
                                    placeholder="Masukkan Email" value="{{$EMAIL}}">
                                </div>
                            </div> 
 
							<div class="form-group row">
                                <div class="col-md-2">
                                    <label for="NPWP" class="form-label">NPWP</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control NPWP" id="NPWP"name="NPWP"
                                    placeholder="Masukkan NPWP" value="{{$NPWP}}">
                                </div>
                            </div>

							<div class="form-group row">
                                <div class="col-md-2">
                                    <label for="KET" class="form-label">Ket</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control KET" id="KET"name="KET"
                                    placeholder="Masukkan Ket" value="{{$KET}}">
                                </div>
                            </div>
        
		
						</div>

							
							<div id="bankInfo" class="tab-pane">
				
								<div class="form-group row">
									<div class="col-md-2">
										<label for="BANK" class="form-label">Bank</label>
									</div>
									<div class="col-md-4">
										<input type="text" class="form-control BANK" id="BANK" name="BANK" placeholder="Masukkan Bank" value="{{$BANK}}">
									</div>                                
								</div>

								<div class="form-group row">							       
									<div class="col-md-2">
										<label for="BANK_CAB" class="form-label">Cabang</label>
									</div>
									<div class="col-md-4">
										<input type="text" class="form-control BANK_CAB" id="BANK_CAB" name="BANK_CAB" placeholder="Masukkan Cabang" value="{{$BANK_CAB}}">
									</div>
								</div>

								<div class="form-group row">							       
									<div class="col-md-2">
										<label for="BANK_KOTA" class="form-label">Kota</label>
									</div>
									<div class="col-md-4">
										<input type="text" class="form-control BANK_KOTA" id="BANK_KOTA" name="BANK_KOTA" placeholder="Masukkan Kota" value="{{$BANK_KOTA}}">
									</div>
								</div>
								
								<div class="form-group row">
									<div class="col-md-2">
										<label for="BANK_NAMA" class="form-label">A/N</label>
									</div>
									<div class="col-md-4">
										<input type="text" class="form-control BANK_NAMA" id="BANK_NAMA" name="BANK_NAMA" placeholder="Masukkan Nama" value="{{$BANK_NAMA}}">
									</div>                                
								</div>
								
								<div class="form-group row">
									<div class="col-md-2">
										<label for="BANK_REK" class="form-label">Rek</label>
									</div>
									<div class="col-md-4">
										<input type="text" class="form-control BANK_REK" id="BANK_REK" name="BANK_REK" placeholder="Masukkan Nomor Rekening" value="{{$BANK_REK}}">
									</div>                                
								</div>
							
							
								<div class="form-group row">
									<div class="col-md-2">
										<label for="HARI" class="form-label">Janji Hari</label>
									</div>
									<div class="col-md-4">
										<input type="text" class="form-control HARI" id="HARI" name="HARI" placeholder="Masukkan Jumlah Hari" value="{{$HARI}}">
									</div>                                
								</div>
								
							</div>
						</div> 
        
                            <hr style="margin-top: 30px; margin-buttom: 30px">
                            
                           
                        </div>
        
                        <div class="mt-3">
                            <button type="submit"  class="btn btn-success"><i class="fa fa-save"></i> Save</button>										
                            <a type="button" href="javascript:javascript:history.go(-1)" class="btn btn-danger">Cancel</a>
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
@endsection

@section('footer-scripts')
<script>
    var target;
	var idrow = 1;

    $(document).ready(function () {
        $('body').on('click', '.btn-delete', function() {
			var val = $(this).parents("tr").remove();
			idrow--;
			nomor();
		});
    });

    function nomor() {
	}

    function tambah() {
     }
     
     
     var hasilCek;
	function cekSup(kodes) {
		$.ajax({
			type: "GET",
			url: "{{url('sup/ceksup')}}",
            async: false,
			data: ({ KODES: kodes, }),
			success: function(data) {
                if (data.length > 0) {
                    $.each(data, function(i, item) {
                        hasilCek=data[i].ADA;
                    });
                }
			},
			error: function() {
				alert('Error cekSup occured');
			}
		});
		return hasilCek;
	}
    
	function simpan() {
        cekSup($('#KODES').val());
        (hasilCek==0) ? document.getElementById("entri").submit() : alert('Suplier '+$('#KODES').val()+' sudah ada!');
	}
</script>
@endsection

