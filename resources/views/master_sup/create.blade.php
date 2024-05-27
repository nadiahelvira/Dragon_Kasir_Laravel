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
            <h1 class="m-0">Tambah Data Suplier Baru</h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/sup">Master Suplier</a></li>
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
                    <form action="store" method="POST" id="entri">
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
                                    <label for="KODES" class="form-label">Suplier</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control KODES" id="KODES" name="KODES"  placeholder="Masukkan Kode Suplier"  >
                                </div>                                
                            </div>
        
							<div class="form-group row">
								       
                                <div class="col-md-2">
                                    <label for="NAMAS" class="form-label">Nama</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control NAMAS" id="NAMAS" name="NAMAS" placeholder="Masukkan Nama Suplier">
                                </div>
                            </div>				
				
                            <div class="form-group row">
                                <div class="col-md-2">
                                    <label for="ALAMAT" class="form-label">Alamat</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control ALAMAT" id="ALAMAT" name="ALAMAT" placeholder="Masukkan Alamat">
                                </div>                             
                            </div>
 
                           <div class="form-group row">      
                                <div class="col-md-2">
                                    <label for="KOTA" class="form-label">Kota</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control KOTA" id="KOTA" name="KOTA" placeholder="Masukkan Kota">
                                </div>
                            </div>

                           <div class="form-group row">      
                                <div class="col-md-2">
                                    <label for="GOL" class="form-label">Gol</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control GOL" id="GOL" name="GOL" placeholder="Masukkan Gol">
                                </div>
                            </div>
							
							<div class="form-group row">
                                <div class="col-md-2">
                                    <label for="TELPON1" class="form-label">Telpon</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control TELPON1" id="" name="TELPON1" placeholder="Masukkan Telpon">
                                </div>                             
                            </div>
							
							<div class="form-group row">
                                <div class="col-md-2">
                                    <label for="FAX" class="form-label">Fax</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control FAX" id="FAX" name="FAX" placeholder="Masukkan Fax">
                                </div>                             
                            </div>
							
							<div class="form-group row">
                                <div class="col-md-2">
                                    <label for="HP" class="form-label">HP</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control HP" id="HP" name="HP" placeholder="Masukkan HP">
                                </div>   

							<!-- <div class="col-md-2">
									<label for="AKT" class="form-label">Aktif</label>
								</div> -->
									
								<div class="col-md-6">
									<input type="checkbox" class="form-check-input" id="AKT" name="AKT" value="1">
									<label for="AKT">Aktif</label>
										
								</div>  								
							</div>

							
							<div class="form-group row">
                                <div class="col-md-2">
                                    <label for="KONTAK" class="form-label">Kontak</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control KONTAK" id="KONTAK" name="KONTAK" placeholder="Masukkan Kontak">
                                </div>                             
                            </div>
							
							<div class="form-group row">
                                <div class="col-md-2">
                                    <label for="EMAIL" class="form-label">Email</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control EMAIL" id="EMAIL" name="EMAIL" placeholder="Masukkan Email">
                                </div>                             
                            </div>
							
							<div class="form-group row">
                                <div class="col-md-2">
                                    <label for="NPWP" class="form-label">NPWP<label>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control NPWP" id="NPWP" name="NPWP" placeholder="Masukkan NPWP">
                                </div>                             
                            </div>

							<div class="form-group row">
                                <div class="col-md-2">
                                    <label for="KET" class="form-label">Ket</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control KET" id="KET" name="KET" placeholder="Masukkan Ket">
                                </div>    
								<div class="col-md-6">
									<input type="checkbox" class="form-check-input" id="PN" name="PN" value="1">
									<label for="PN">PN</label>
								</div>  								
                            </div>
						
						
							</div>

							
							<div id="bankInfo" class="tab-pane">
				
								<div class="form-group row">
									<div class="col-md-2">
										<label for="BANK" class="form-label">Bank</label>
									</div>
									<div class="col-md-4">
										<input type="text" class="form-control BANK" id="BANK" name="BANK" placeholder="Masukkan Bank">
									</div>                                
								</div>

								<div class="form-group row">							       
									<div class="col-md-2">
										<label for="BANK_CAB" class="form-label">Cabang</label>
									</div>
									<div class="col-md-4">
										<input type="text" class="form-control BANK_CAB" id="BANK_CAB" name="BANK_CAB" placeholder="Masukkan Cabang">
									</div>
								</div>

								<div class="form-group row">							       
									<div class="col-md-2">
										<label for="BANK_KOTA" class="form-label">Kota</label>
									</div>
									<div class="col-md-4">
										<input type="text" class="form-control BANK_KOTA" id="BANK_KOTA" name="BANK_KOTA" placeholder="Masukkan Kota">
									</div>
								</div>
								
								<div class="form-group row">
									<div class="col-md-2">
										<label for="BANK_NAMA" class="form-label">A/N</label>
									</div>
									<div class="col-md-4">
										<input type="text" class="form-control BANK_NAMA" id="BANK_NAMA" name="BANK_NAMA" placeholder="Masukkan Nama">
									</div>                                
								</div>
								
								<div class="form-group row">
									<div class="col-md-2">
										<label for="BANK_REK" class="form-label">Rek</label>
									</div>
									<div class="col-md-4">
										<input type="text" class="form-control BANK_REK" id="BANK_REK" name="BANK_REK" placeholder="Masukkan Nomor Rekening">
									</div>                                
								</div>
								
								
								<div class="form-group row">
									<div class="col-md-2">
										<label for="HARI" class="form-label">Janji Hari</label>
									</div>
									<div class="col-md-4">
										<input type="text" class="form-control HARI" id="HARI" name="HARI" placeholder="Masukkan Jumlah Hari" value = '0' >
									</div>                                
								</div>
								
							</div>
						</div> 
 
 
                          <div class="mt-3">
                            <button type="button" onclick=simpan() class="btn btn-success"><i class="fa fa-save"></i> Save</button>										
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
		var i = 1;
		$(".REC").each(function() {
			$(this).val(i++);
		});
		// hitung();
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


