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
					<h1 class="m-0">Tambah BG</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="/bg">Transaksi BG </a></li>
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
                                    <label for="JENIS" class="form-label">Jenis</label>
                                </div>
                                <div class="col-md-4">
                                      <select id="JENIS" class="form-control" name="JENIS">
										<option value="BILYET-GIRO" >BILYET-GIRO</option>
										<option value="CEK-BRI" >CEK-BRI</option>
										<option value="CEK" >CEK</option>
										<option value="SLIP-SETORAN" >SLIP-SETORAN</option>
										<option value="SLIP-TRANSFER" >SLIP-TRANSFER</option>
									  </select>
                                </div>
                            </div>
							
                            <div class="form-group row">
								<div class="col-md-2" align="right">
                                   <label for="NO_BUKTI" class="form-label">Bukti#</label>
                                </div>
                                <div class="col-md-2">
                                    <input type="text" class="form-control NO_BUKTI" id="NO_BUKTI" name="NO_BUKTI" placeholder="Masukkan Bukti#" value="+" readonly>
                                </div>
								
								<div class="col-md-1" align="right">
                                    <label for="SERIES" class="form-label">Series</label>
                                </div>
                                <div class="col-md-2">
                                    <input type="text" class="form-control SERIES" id="SERIES" name="SERIES" placeholder="Masukkan Series" >
                                </div>
        
                                <div class="col-md-1" align="right">
                                    <label for="TGL" class="form-label">Tgl</label>
                                </div>
                                <div class="col-md-2">
                                   <input class="form-control date" id="TGL" name="TGL" data-date-format="dd-mm-yyyy" type="text" autocomplete="off" value="{{ now()->format('d-m-Y') }}" >
                                </div>
                            </div>
							
							<div class="form-group row">
								<div class="col-md-2" align="right">								
                                    <label for="PERUSAHAAN" class="form-label">Perusahaan</label>
                                </div>
                               
                                <div class="col-md-4 input-group" >
                                  <input type="text" class="form-control PERUSAHAAN" id="PERUSAHAAN" name="PERUSAHAAN" placeholder="Masukkan No Rekening" value="" style="text-align: left" >
        							
                                </div>
								
								<div class="col-md-2" align="right">
                                    <label for="JTEMPO" class="form-label">Jtempo</label>
                                </div>
                                <div class="col-md-2">
                                   <input class="form-control date" id="JTEMPO" name="JTEMPO" data-date-format="dd-mm-yyyy" type="text" autocomplete="off" value="{{ now()->format('d-m-Y') }}" >
                                </div>
                            </div>
							
							<div class="form-group row">
								<div class="col-md-2" align="right">								
                                    <label for="NOREK" class="form-label">No Rek</label>
                                </div>
                               
                                <div class="col-md-4 input-group" >
                                  <input type="text" class="form-control NOREK" id="NOREK" name="NOREK" placeholder="Masukkan No Rekening" value="" style="text-align: left" >
        							
                                </div>
                            </div>
							
                            <div class="form-group row">
								<div class="col-md-2" align="right">
									<label style="color:red">*</label>									
                                    <label for="PENERIMA" class="form-label">Penerima</label>
                                </div>
                               
                                <div class="col-md-4 input-group" >
                                  <input type="text" class="form-control PENERIMA" id="PENERIMA" name="PENERIMA" placeholder="Masukkan Penerima" value="" style="text-align: left" >
        							
                                </div>
								
								<div class="col-md-2" align="right">								
                                    <label for="NM_PENGIRIM" class="form-label">Nama Pengirim</label>
                                </div>
                               
                                <div class="col-md-4 input-group" >
                                  <input type="text" class="form-control NM_PENGIRIM" id="NM_PENGIRIM" name="NM_PENGIRIM" placeholder="Masukkan Nama Pengirim" value="" style="text-align: left" >
        							
                                </div>
                            </div>
							
							<div class="form-group row">
								<div class="col-md-2" align="right">
									<label style="color:red">*</label>									
                                    <label for="ALM_PENERIMA" class="form-label">Alamat Penerima</label>
                                </div>
                               
                                <div class="col-md-4 input-group" >
                                  <input type="text" class="form-control ALM_PENERIMA" id="ALM_PENERIMA" name="ALM_PENERIMA" placeholder="Masukkan Alamat" value="" style="text-align: left" >
        							
                                </div>
								
								<div class="col-md-2" align="right">									
                                    <label for="ALM_PENGIRIM" class="form-label">Alamat Pengirim</label>
                                </div>
                               
                                <div class="col-md-4 input-group" >
                                  <input type="text" class="form-control ALM_PENGIRIM" id="ALM_PENGIRIM" name="ALM_PENGIRIM" placeholder="Masukkan Alamat" value="" style="text-align: left" >
        							
                                </div>
                            </div>
							
							<div class="form-group row">
								<div class="col-md-2" align="right">
									<label style="color:red">*</label>									
                                    <label for="BANK_PENERIMA" class="form-label">Bank Penerima</label>
                                </div>
                                <div class="col-md-4 input-group" >
                                  <input type="text" class="form-control BANK_PENERIMA" id="BANK_PENERIMA" name="BANK_PENERIMA" placeholder="Masukkan Alamat" value="" style="text-align: left" >
        							
                                </div>
								
								<div class="col-md-2" align="right">								
                                    <label for="TELP_PENGIRIM" class="form-label">Telp Pengirim</label>
                                </div>
                                <div class="col-md-3 input-group" >
                                  <input type="text" class="form-control TELP_PENGIRIM" id="TELP_PENGIRIM" name="TELP_PENGIRIM" placeholder="Masukkan Telp" value="" style="text-align: left" >
        							
                                </div>
								
								<div class="col-md-1">
                                        <input type="checkbox" class="form-check-input" id="PAKAI" name="PAKAI" value="0">
                                        <label for="PAKAI">Pakai</label>
                                    </div>
                            </div>
							
							<div class="form-group row">
								<div class="col-md-2" align="right">								
                                    <label for="ALM_BANK" class="form-label">Alamat Bank</label>
                                </div>
                               
                                <div class="col-md-4 input-group" >
                                  <input type="text" class="form-control ALM_BANK" id="ALM_BANK" name="ALM_BANK" placeholder="Masukkan Alamat" value="" style="text-align: left" >
        							
                                </div>
								
								<div class="col-md-2" align="right">								
                                    <label for="NOREK_PENGIRIM" class="form-label">Rek Pengirim</label>
                                </div>
                               
                                <div class="col-md-3 input-group" >
                                  <input type="text" class="form-control NOREK_PENGIRIM" id="NOREK_PENGIRIM" name="NOREK_PENGIRIM" placeholder="Masukkan Alamat" value="" style="text-align: left" >
        							
                                </div>
                            </div>
							
							<div class="form-group row">

                                <div class="col-md-2" align="right">
                                    <label for="JUMLAH" class="form-label">Jumlah</label>
                                </div>
                                <div class="col-md-2" align="left">
                                    <input type="text" class="form-control JUMLAH" id="JUMLAH" name="JUMLAH" placeholder="JUMLAH" value="{{ number_format(0, 2, '.', ',') }}" style="text-align: right" >
                                </div>
								
								 <div class="col-md-1" align="right">
                                    <label for="BIAYA" class="form-label">Biaya</label>
                                </div>
                                <div class="col-md-2" align="left">
                                    <input type="text" class="form-control BIAYA" id="BIAYA" name="BIAYA" placeholder="BIAYA" value="{{ number_format(0, 2, '.', ',') }}" style="text-align: right" >
                                </div>
								
								<div class="col-md-1" align="right">								
                                    <label for="PEMBAYARAN" class="form-label">Untuk Pembayaran</label>
                                </div>
                               
                                <div class="col-md-3 input-group" >
                                  <input type="text" class="form-control PEMBAYARAN" id="PEMBAYARAN" name="PEMBAYARAN" placeholder="Masukkan Keterangan" value="" style="text-align: left" >
        							
                                </div>
                            </div>
							
							<div class="form-group row">
								<div class="col-md-2">
                                </div>
								
								<div class="col-md-1">
                                        <input type="checkbox" class="form-check-input" id="REVISI" name="REVISI" value="0">
                                        <label for="REVISI">Revisi</label>
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

		$("#JUMLAH").autoNumeric('init', {aSign: '<?php echo ''; ?>',vMin: '-999999999.99'});
		$("#BIAYA").autoNumeric('init', {aSign: '<?php echo ''; ?>',vMin: '-999999999.99'});


		
		$(".date").datepicker({
			'dateFormat': 'dd-mm-yy',
		})
		
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
		
</script>
@endsection