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
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
               <h1 class="m-0">Edit Slip {{$NO_BUKTI}}</h1>	
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{url('/slip')}}">Slip</a></li>
                <li class="breadcrumb-item active">Edit {{$NO_BUKTI}}</li>
            </ol>
            </div>
        </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
        <div class="row">
            <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{url('/slip/update/'.$NO_ID)}}" id="entri" method="POST">
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
                                <div class="col-md-2" align="right">
                                    <label for="JENIS" class="form-label">Slip Untuk</label>
                                </div>
                                <div class="col-md-2">
                                      <select id="JENIS" class="form-control" name="JENIS">
										<option value="PMS" >Pemasaran</option>
										<option value="GJ" >Gaji OS</option>
									  </select>
                                </div>

                                <div class="col-md-z">
                                    <input type="text" class="form-control WILAYAH" id="WILAYAH" name="WILAYAH" placeholder="" value="{{$WILAYAH}}" readonly>
                                </div>
								
								<div class="col-md-1" align="right">
                                    <label for="TGL" class="form-label">Tgl Setor</label>
                                </div>
                                <div class="col-md-2">
                                   <input class="form-control date" id="TGL" name="TGL" data-date-format="dd-mm-yyyy" type="text" autocomplete="off" value="{{date('d-m-Y',strtotime($TGL))}}" >
                                </div>
								
								<div class="col-md-1" align="right">
                                   <label for="KOTA_SETOR" class="form-label">Kota Setor</label>
                                </div>
                                <div class="col-md-2">
                                    <input type="text" class="form-control KOTA_SETOR" id="KOTA_SETOR" name="KOTA_SETOR" placeholder="Masukkan Kota" value="{{$KOTA}}">
                                </div>
                            </div>
							
                            <div class="form-group row">
								<div class="col-md-2" align="right">
                                    <label for="NO_REK" class="form-label">No Rek</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control NOREK" id="NOREK" name="NOREK" placeholder="Masukkan Rek#" value="{{$NOREK}}" readonly >
                                </div>
								
								<div class="col-md-1" align="right">
                                   <label for="NO_BUKTI" class="form-label">Series</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control NO_BUKTI" id="NO_BUKTI" name="NO_BUKTI" placeholder="Masukkan Bukti#" value="{{$NO_BUKTI}}" readonly>
                                </div>
                            </div>
							
							<div class="form-group row">
								<div class="col-md-2" align="right">								
                                    <label for="BANK" class="form-label">Bank Penerima</label>
                                </div>
                                <div class="col-md-4 input-group" >
                                  <input type="text" class="form-control BANK" id="BANK" name="BANK" placeholder="" style="text-align: left" value="{{$BANK}}" readonly>
                                </div>
                            </div>

                            <div class="form-group row">
								<div class="col-md-2" align="right">
									<label style="color:red">*</label>									
                                    <label for="NAMA" class="form-label">Nama</label>
                                </div>
                                <div class="col-md-4 input-group" >
                                  <input type="text" class="form-control NAMA" id="NAMA" name="NAMA" placeholder="Masukkan Nama" style="text-align: left" value="{{$NAMA}}" readonly>
                                </div>
                            </div>
							
							<div class="form-group row">
								<div class="col-md-2" align="right">							
                                    <label for="TELPON1" class="form-label">No Telepon</label>
                                </div>
                                <div class="col-md-4 input-group" >
                                  <input type="text" class="form-control TELPON1" id="TELPON1" name="TELPON1" placeholder=""  style="text-align: left" value="{{$TELPON1}}" readonly>
                                </div>
                            </div>
							
							<div class="form-group row">
                                <div class="col-md-2" align="right">
                                    <label for="ALAMAT" class="form-label">Alamat</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control ALAMAT" id="ALAMAT" name="ALAMAT" placeholder="Alamat" value="{{$ALAMAT}}" readonly>
                                </div>
                            </div>
							
							<div class="form-group row">
                                <div class="col-md-2" align="right">
                                    <label for="KOTA" class="form-label">Kota</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control KOTA" id="KOTA" name="KOTA" placeholder="Masukkan Kota" value="{{$KOTA}}" readonly>
                                </div>
                            </div>
							
							<div class="form-group row">
								<div class="col-md-2" align="right">
                                    <label for="JTEMPO" class="form-label">Jtempo</label>
                                </div>
                                <div class="col-md-2">
                                   <input class="form-control date" id="JTEMPO" name="JTEMPO" data-date-format="dd-mm-yyyy" type="text" autocomplete="off" value="{{date('d-m-Y',strtotime($JTEMPO))}}">
                                </div>
							</div>
							
							<div class="form-group row">
                                <div class="col-md-2" align="right">
                                    <label for="TOTAL" class="form-label">Jumlah</label>
                                </div>
                                <div class="col-md-3" align="left">
                                    <input type="text" class="form-control TOTAL" id="TOTAL" name="TOTAL" placeholder="Total" value="{{$TOTAL}}" style="text-align: right" >
                                </div>
							</div>
							
							<div class="form-group row">
                                <div class="col-md-2" align="right">
                                    <label for="BIAYA" class="form-label">Biaya</label>
                                </div>
                                <div class="col-md-3" align="left">
                                    <input type="text" class="form-control BIAYA" id="BIAYA" name="BIAYA" placeholder="Biaya" value="{{$BIAYA}}" style="text-align: right" >
                                </div>
							</div>
                        </div>

                        <div class="mt-3">
                            <div class="form-group row">
                                <div class="col-md-2">
                                </div>
                                <div class="col-md-4">
									 @if ($POSTED == '0')
									   <button type="button" onclick="simpan()" class="btn btn-success"><i class="fa fa-save"></i> Save</button>										
									@endif 									
									<a type="button" href="javascript:javascript:history.go(-1)" class="btn btn-danger">Cancel</a>
                                </div>
							</div>
                        </div>
                    </form>
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>
	

	<div class="modal fade" id="browsePoModal" tabindex="-1" role="dialog" aria-labelledby="browsePoModalLabel" aria-hidden="true">
	  <div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title" id="browsePoModalLabel">Cari Po#</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>
		  <div class="modal-body">
			<table class="table table-stripped table-bordered" id="table-bpo">
				<thead>
					<tr>
						<th>Po#</th>
						<th>Suplier</th>
						<th>Barang</th>
						<th>Harga</th>
						<th>Kg</th>
						<th>Kirim</th>
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
	
<div class="modal fade" id="browseAccountModal" tabindex="-1" role="dialog" aria-labelledby="browseAccountModalLabel" aria-hidden="true">
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
						<th>Acc#</th>
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
	

	<div class="modal fade" id="browseMklModal" tabindex="-1" role="dialog" aria-labelledby="browseMklModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title" id="browseMklModalLabel">Cari EMKL</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>
		  <div class="modal-body">
			<table class="table table-stripped table-bordered" id="table-bmkl">
				<thead>
					<tr>
						<th>Kode</th>
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
<script src="{{ asset('js/autoNumerics/autoNumeric.min.js') }}"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script> -->
<script src="{{asset('foxie_js_css/bootstrap.bundle.min.js')}}"></script>

<script>
	var idrow = 1;
    function numberWithCommas(x) {
		return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
	}

	$(document).ready(function() {

		$("#TOTAL").autoNumeric('init', {aSign: '<?php echo ''; ?>',vMin: '-999999999.99'});
		$("#BIAYA").autoNumeric('init', {aSign: '<?php echo ''; ?>',vMin: '-999999999.99'});


		
		$(".date").datepicker({
			'dateFormat': 'dd-mm-yy',
		})
		
			
					
///////////////////////////////////////////////////////////////////////

		var dTableBPo;
		loadDataBPo = function(){
			$.ajax(
			{
				type: 'GET',    
				url: "{{url('po/browse')}}",
				data: {
					'GOL': 'Y',
				},
				success: function( response )
				{
					resp = response;
					if(dTableBPo){
						dTableBPo.clear();
					}
					for(i=0; i<resp.length; i++){
						
						dTableBPo.row.add([
							'<a href="javascript:void(0);" onclick="choosePo(\''+resp[i].NO_PO+'\', \''+resp[i].KODES+'\',  \''+resp[i].NAMAS+'\', \''+resp[i].ALAMAT+'\',  \''+resp[i].KOTA+'\',  \''+resp[i].KD_BRG+'\' ,  \''+resp[i].NA_BRG+'\' ,  \''+resp[i].KG+'\',  \''+resp[i].HARGA+'\'            )">'+resp[i].NO_PO+'</a>',
							resp[i].NAMAS,
							resp[i].NA_BRG,
							resp[i].HARGA,							
							Intl.NumberFormat('en-US').format(resp[i].KG),	
							Intl.NumberFormat('en-US').format(resp[i].KIRIM),	
							Intl.NumberFormat('en-US').format(resp[i].SISA),	
							
						]);
					}
					dTableBPo.draw();
				}
			});
		}
		
		dTableBPo = $("#table-bpo").DataTable({
			
		});
		
		browsePo = function(){
			loadDataBPo();
			$("#browsePoModal").modal("show");
		}
		
		choosePo = function(NO_PO,KODES, NAMAS, ALAMAT, KOTA, KD_BRG, NA_BRG, KG, HARGA, KIRIM, SISA ){
			$("#NO_PO").val(NO_PO);
			$("#KODES").val(KODES);
			$("#NAMAS").val(NAMAS);
			$("#ALAMAT").val(ALAMAT);
			$("#KOTA").val(KOTA);
			$("#KD_BRG").val(KD_BRG);
			$("#NA_BRG").val(NA_BRG);
			$("#KG").val(SISA);				
			$("#HARGA").val(HARGA);
			$("#browsePoModal").modal("hide");
			
			hitung();
		}
		
		$("#NO_PO").keypress(function(e){

			if(e.keyCode == 46){
				e.preventDefault();
				browsePo();
			}
		}); 
		
		
		//////////////////////////////////////

 		var dTableBAccount;
		loadDataBAccount = function(){
			$.ajax(
			{
				type: 'GET',    
				url: '{{url('account/browse')}}',
				success: function( response )
				{
					resp = response;
					if(dTableBAccount){
						dTableBAccount.clear();
					}
					for(i=0; i<resp.length; i++){
						
						dTableBAccount.row.add([
							'<a href="javascript:void(0);" onclick="chooseAccount(\''+resp[i].ACNO+'\',  \''+resp[i].NAMA+'\' )">'+resp[i].ACNO+'</a>',
							resp[i].NAMA,
						]);
					}
					dTableBAccount.draw();
				}
			});
		}
		
		dTableBAccount = $("#table-baccount").DataTable({
			
		});
		
		browseAccount = function(){
			loadDataBAccount();
			$("#browseAccountModal").modal("show");
		}
		
		chooseAccount = function(ACNO, NAMA){
			$("#ACNOA").val(ACNO);
			$("#NACNOA").val(NAMA);
			$("#browseAccountModal").modal("hide");
		}
		
		$("#ACNOA").keypress(function(e){
			if(e.keyCode == 46){
				e.preventDefault();
				browseAccount();
			}
		});
		
		
		///////////////////////////////////////////////////////////////////////////////////////////////		
		var dTableBMkl;
		var rowidMkl;
		loadDataBMkl = function(){
			$.ajax(
			{
				type: 'GET',    
				url: "{{url('mkl/browse')}}",

				success: function( response )
				{
					resp = response;
					if(dTableBMkl){
						dTableBMkl.clear();
					}
					for(i=0; i<resp.length; i++){
						
						dTableBMkl.row.add([
							'<a href="javascript:void(0);" onclick="chooseMkl(\''+resp[i].KODE+'\',  \''+resp[i].NAMA+'\' )">'+resp[i].KODE+'</a>',
							resp[i].NAMA,
						
						]);
					}
					dTableBMkl.draw();
				}
			});
		}
		
		dTableBMkl = $("#table-bmkl").DataTable({
			
		});
		
		browseMkl = function(){
			loadDataBMkl();
			$("#browseMklModal").modal("show");
		}
		
		chooseMkl = function(KODE,NAMA){
			$("#EMKL").val(NAMA);			
			$("#browseMklModal").modal("hide");
		}
		
		
		$("#EMKL").keypress(function(e){
			if(e.keyCode == 46){
				e.preventDefault();
				browseMkl();
			}
		}); 	
 		
		/*
		$("#KA").keypress(function(e){

			if(e.keyCode == 46){
				e.preventDefault();
				browseRefa();
			}
		}); */
		
		//////////////////////////////////////////////////////////////////////////////////////////////////
	});		



 	function simpan() {
		
		var tgl = $('#TGL').val();
		var bulanPer = {{session()->get('periode')['bulan']}};
		var tahunPer = {{session()->get('periode')['tahun']}};
		
        var check = '0';
		
		
			if ( $('#NO_PO').val()=='' ) 
            {			
			    check = '1';
				alert("PO# Harus diisi.");
			}
			
			if ( tgl.substring(3,5) != bulanPer ) 
			{
				check = '1';
				alert("Bulan tidak sama dengan Periode");
			}	
			
			if ( tgl.substring(tgl.length-4) != tahunPer )
			{
				check = '1';
				alert("Tahun tidak sama dengan Periode");
		    }	 


			if ( check == '0' )
			{
		      document.getElementById("entri").submit();  
			}
			
	}
		
	//////////////////////////////////////////////////////////////////////
</script>
@endsection