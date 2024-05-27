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
					<h1 class="m-0">Tambah Slip</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="/slip">Transaksi Slip </a></li>
						<li class="breadcrumb-item active">Add</li>
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
                    <form action="store" id="entri"  method="POST">
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
                                    <input type="text" class="form-control WILAYAH" id="WILAYAH" name="WILAYAH" placeholder="" readonly >
                                </div>
								
								<div class="col-md-1" align="right">
                                    <label for="TGL_SETOR" class="form-label">Tgl Setor</label>
                                </div>
                                <div class="col-md-2">
                                   <input class="form-control date" id="TGL_SETOR" name="TGL_SETOR" data-date-format="dd-mm-yyyy" type="text" autocomplete="off" value="{{ now()->format('d-m-Y') }}" >
                                </div>
								
								<div class="col-md-1" align="right">
                                   <label for="KOTA_SETOR" class="form-label">Kota Setor</label>
                                </div>
                                <div class="col-md-2">
                                    <input type="text" class="form-control KOTA_SETOR" id="KOTA_SETOR" name="KOTA_SETOR" placeholder="Masukkan Kota" >
                                </div>
                            </div>
							
                            <div class="form-group row">
								<div class="col-md-2" align="right">
                                    <label for="NO_REK" class="form-label">No Rek</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control NOREK" id="NO_REK" name="NOREK" placeholder="Masukkan Rek#" readonly >
                                </div>
								
								<div class="col-md-1" align="right">
                                   <label for="NO_BUKTI" class="form-label">Series</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control NO_BUKTI" id="NO_BUKTI" name="NO_BUKTI" placeholder="Masukkan Bukti#" value="+" readonly>
                                </div>
                            </div>
							
							<div class="form-group row">
								<div class="col-md-2" align="right">								
                                    <label for="BANK" class="form-label">Bank Penerima</label>
                                </div>
                                <div class="col-md-4 input-group" >
                                  <input type="text" class="form-control BANK" id="BANK" name="BANK" placeholder="" value="" style="text-align: left" readonly >
                                </div>
                            </div>

                            <div class="form-group row">
								<div class="col-md-2" align="right">
									<label style="color:red">*</label>									
                                    <label for="NAMA" class="form-label">Nama</label>
                                </div>
                                <div class="col-md-4 input-group" >
                                  <input type="text" class="form-control NAMA" id="NAMA" name="NAMA" placeholder="Masukkan Nama" value="" style="text-align: left" readonly >
                                </div>
                            </div>
							
							<div class="form-group row">
								<div class="col-md-2" align="right">							
                                    <label for="TELPON1" class="form-label">No Telepon</label>
                                </div>
                                <div class="col-md-4 input-group" >
                                  <input type="text" class="form-control TELPON1" id="TELPON1" name="TELPON1" placeholder="" value="" style="text-align: left" readonly >
                                </div>
                            </div>
							
							<div class="form-group row">
                                <div class="col-md-2" align="right">
                                    <label for="ALAMAT" class="form-label">Alamat</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control ALAMAT" id="ALAMAT" name="ALAMAT" placeholder="Alamat" readonly>
                                </div>
                            </div>
							
							<div class="form-group row">
                                <div class="col-md-2" align="right">
                                    <label for="KOTA" class="form-label">Kota</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control KOTA" id="KOTA" name="KOTA" placeholder="Masukkan Kota" readonly>
                                </div>
                            </div>
							
							<div class="form-group row">
								<div class="col-md-2" align="right">
                                    <label for="JTEMPO" class="form-label">Jtempo</label>
                                </div>
                                <div class="col-md-2">
                                   <input class="form-control date" id="JTEMPO" name="JTEMPO" data-date-format="dd-mm-yyyy" type="text" autocomplete="off" value="{{ now()->format('d-m-Y') }}" >
                                </div>
							</div>
							
							<div class="form-group row">
                                <div class="col-md-2" align="right">
                                    <label for="TOTAL" class="form-label">Jumlah</label>
                                </div>
                                <div class="col-md-3" align="left">
                                    <input type="text" class="form-control TOTAL" id="TOTAL" name="TOTAL" placeholder="Total" value="{{ number_format(0, 2, '.', ',') }}" style="text-align: right" >
                                </div>
							</div>
							
							<div class="form-group row">
                                <div class="col-md-2" align="right">
                                    <label for="BIAYA" class="form-label">Biaya</label>
                                </div>
                                <div class="col-md-3" align="left">
                                    <input type="text" class="form-control BIAYA" id="BIAYA" name="BIAYA" placeholder="Biaya" value="{{ number_format(0, 2, '.', ',') }}" style="text-align: right" >
                                </div>
							</div>
                        </div>

                        <div class="mt-3">
                            <div class="form-group row">
                                <div class="col-md-2">
                                </div>
                                <div class="col-md-4">
									<button type="button" onclick="simpan()" class="btn btn-success"><i class="fa fa-save"></i> Save</button>										
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




	<div class="modal fade" id="browseWilaModal" tabindex="-1" role="dialog" aria-labelledby="browseWilaModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title" id="browseWilaModalLabel">Cari Wilayah</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>
		  <div class="modal-body">
			<table class="table table-stripped table-bordered" id="table-bwila">
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



		var dTableBWila;
		loadDataBWila = function(){
			$.ajax(
			{
				type: 'GET',    
				url: '{{url('wila/browse')}}',
				success: function( response )
				{
					resp = response;
					if(dTableBWila){
						dTableBWila.clear();
					}
					for(i=0; i<resp.length; i++){
						
						dTableBWila.row.add([
							'<a href="javascript:void(0);" onclick="chooseWila(\''+resp[i].KODE+'\',  \''+resp[i].NAMA+'\', \''+resp[i].NO_REK+'\' , \''+resp[i].BANK+'\', \''+resp[i].TELPON+'\', \''+resp[i].ALAMAT+'\', \''+resp[i].KOTA+'\'   )">'+resp[i].KODE+'</a>',
							resp[i].NAMA,
						]);
					}
					dTableBWila.draw();
				}
			});
		}
		
		dTableBWila = $("#table-bwila").DataTable({
			
		});
		
		browseWila = function(){
			loadDataBWila();
			$("#browseWilaModal").modal("show");
		}
		
		chooseWila = function(KODE, NAMA, NO_REK, BANK, TELPON, ALAMAT, KOTA){
			$("#WILAYAH").val(KODE);
			$("#NAMA").val(NAMA);
			$("#NO_REK").val(NO_REK);
			$("#BANK").val(BANK);
			$("#TELPON1").val(TELPON);
			$("#ALAMAT").val(ALAMAT);
			$("#KOTA").val(KOTA);
			
			$("#browseWilaModal").modal("hide");
		}
		
		$("#WILAYAH").keypress(function(e){
			if(e.keyCode == 46){
				e.preventDefault();
				browseWila(0);
			}
		});
//////////////////////////////////////////////////////////////////////////	
	});		

	
	
 	function simpan() {
		
		var tgl = $('#TGL_SETOR').val();
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
		
</script>
@endsection