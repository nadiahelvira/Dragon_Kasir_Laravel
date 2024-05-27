@extends('layouts.main')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
			
<!--// ganti 1 -->
			
            <h1 class="m-0">Tambah Data KS_slip Baru</h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">

<!--// ganti 2 -->
                <li class="breadcrumb-item"><a href="/wila">Master Ks-Slip</a></li>
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
                    <form action="store" method="POST"  id="entri">
                        @csrf

    
	
                        <div class="tab-content mt-3">
							<div class="form-group row">
									<div class="col-md-2">
										<label for="KODE" class="form-label">Kode</label>
									</div>
									<div class="col-md-4">
										<input type="text" class="form-control KODE" id="KODE" name="KODE" placeholder="Masukkan Kode">
									</div>
					
							</div>
								
							<div class="form-group row">
									<div class="col-md-2">
										<label for="NAMA" class="form-label">Nama</label>
									</div>
									<div class="col-md-4">
										<input type="text" class="form-control NAMA" id="NAMA" name="NAMA" placeholder="Masukkan Nama" required>
									</div>                             
							</div>
        
 
							<div class="form-group row">
									<div class="col-md-2">
										<label for="BANK" class="form-label">Bank</label>
									</div>
									<div class="col-md-2">
										<input type="text" class="form-control BANK" id="BANK" name="BANK" placeholder="Masukkan Bank#" value="">
									</div>                             
							</div>


                            <div class="form-group row">
                                <div class="col-md-2">
                                    <label for="NO_REK" class="form-label">Rek#</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control NO_REK" id="NO_REK" name="NO_REK"
                                    placeholder="Masukkan Rek#" value="">
                                </div>      
             
                            </div>
							
							<div class="form-group row">
									<div class="col-md-2">
										<label for="ALAMAT" class="form-label">Alamat</label>
									</div>
									<div class="col-md-4">
										<input type="text" class="form-control ALAMAT" id="ALAMAT" name="ALAMAT" placeholder="-" value="" >
									</div>                             
							</div>

							<div class="form-group row">
									<div class="col-md-2">
										<label for="KOTA" class="form-label">Kota</label>
									</div>
									<div class="col-md-4">
										<input type="text" class="form-control KOTA" id="KOTA" name="KOTA" placeholder="-" value='' >
									</div>                             
							</div>

							<div class="form-group row">
									<div class="col-md-2">
										<label for="TELPON" class="form-label">Telp</label>
									</div>
									<div class="col-md-4">
										<input type="text" class="form-control TELPON" id="TELPON" name="TELPON" placeholder="-" value='' >
									</div>                             
							</div>

							<div class="form-group row">
									<div class="col-md-2">
										<label for="JENIS" class="form-label">Jenis</label>
									</div>
									<div class="col-md-4">
										<input type="text" class="form-control JENIS" id="JENIS" name="JENIS" placeholder="-" value='' >
									</div>                             
							</div>
							
                            <hr style="margin-top: 30px; margin-buttom: 30px">
                            
                            
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
	<div class="modal fade" id="browseGrupModal" tabindex="-1" role="dialog" aria-labelledby="browseGrupModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title" id="browseGrupModalLabel">Cari Grup</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>
		  <div class="modal-body">
			<table class="table table-stripped table-bordered" id="table-bgrup">
				<thead>
					<tr>
						<th>Grup#</th>
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
    
@endsection

@section('footer-scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    var target;
	var idrow = 1;

    $(document).ready(function () {


		//CHOOSE Bacno
 		var dTableBGrup;
		loadDataBGrup = function(){
			$.ajax(
			{
				type: 'GET',    
				url: '{{url('grup/browse')}}',
				success: function( response )
				{
					resp = response;
					if(dTableBGrup){
						dTableBGrup.clear();
					}
					for(i=0; i<resp.length; i++){
						
						dTableBGrup.row.add([
							'<a href="javascript:void(0);" onclick="chooseGrup(\''+resp[i].KD_GRUP+'\',\''+resp[i].NA_GRUP+'\')">'+resp[i].KD_GRUP+'</a>',
							resp[i].NA_GRUP,
								
						]);
					}
					dTableBGrup.draw();
				}
			});
		}
		
		dTableBGrup = $("#table-bgrup").DataTable({
			
		});
		
		browseGrup = function(){
			loadDataBGrup();
			$("#browseGrupModal").modal("show");
		}
		
		chooseGrup = function(KD_GRUP,NA_GRUP){
			$("#KD_GRUP").val(KD_GRUP);
			$("#NA_GRUP").val(NA_GRUP);
			$("#browseGrupModal").modal("hide");
		}


		$("#KD_GRUP").keypress(function(e){

			if(e.keyCode == 46){
				e.preventDefault();
				browseGrup();
			}
		}); 
		
		
    });





    var hasilCek;
	function cek(kode) {
		$.ajax({
			type: "GET",
			url: "{{url('wila/cek')}}",
            async: false,
			data: ({ KODE: kode, }),
			success: function(data) {
                if (data.length > 0) {
                    $.each(data, function(i, item) {
                        hasilCek=data[i].ADA;
                    });
                }
			},
			error: function() {
				alert('Error cek occured');
			}
		});
		return hasilCek;
	}
    
	function simpan() {
        cek($('#KODE').val());
        (hasilCek==0) ? document.getElementById("entri").submit() : alert('Kode '+$('#KODE').val()+' sudah ada!');
	}
</script>
@endsection

