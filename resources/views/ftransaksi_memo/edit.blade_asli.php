@extends('layouts.main')

<style>
    .card {

    }

    .form-control:focus {
        background-color: #E0FFFF !important;
    }
	
	.table-scrollable {
		margin: 0;
		padding: 0;
	}

	table {
		table-layout: fixed !important;
	}
</style>


@section('content')

<? $judul=$_GET['judul'] ?>
<? $flagz=$_GET['flagz'] ?>


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        
    </div>
    <!-- /.content-header -->

    <div class="content">
        <div class="container-fluid">
        <div class="row">
            <div class="col-12">
            <div class="card">
                <div class="card-body">

                <!--    <form action="{{($tipx=='new')? url('/memo/store?flagz='.$flagz.'') : url('/memo/update/'.$header->NO_ID.'&flagz='.$flagz.'' ) }}" method="POST" name ="entri" id="entri" > -->
						<form action="{{url('/memo/update/'.$header->NO_ID)}}" id="entri" method="POST">
  
						@csrf
                    
         
                        <div class="tab-content mt-3">
        
                            <div class="form-group row">
                                <div class="col-md-1">
                                    <label for="NO_BUKTI" class="form-label">Bukti#</label>
                                </div>
 							

 
							<!--	<input name="tipx" class="form-control tipx" id="tipx" value="{{$tipx}}" hidden>
								<input name="flagz" class="form-control flagz" id="flagz" value="{{$flagz}}" hidden>
							--> 
							
								<input type="text" class="form-control NO_ID" id="NO_ID" name="NO_ID"
										placeholder="Masukkan NO_ID" value="{{$header->NO_ID ?? ''}}" hidden readonly>
									
								<div class="col-md-2">
										<input type="text" class="form-control NO_BUKTI" id="NO_BUKTI" name="NO_BUKTI"
										placeholder="Masukkan Bukti#" value="{{$header->NO_BUKTI ?? ''}}" readonly >
								</div>
								
								<div class="col-md-6"></div>
					
								<div class="col-md-3 input-group">

									<input type="text" class="form-control CARI" id="CARI" name="CARI"
                                    placeholder="Cari Bukti#" value="" >
									<button type="button" id='SEARCHX'  onclick="CariBukti()" class="btn btn-outline-primary"><i class="fas fa-search"></i></button>

								</div> 

								
							</div>	
        
							<div class="form-group row">                              
							  <div class="col-md-1">
                                    <label for="TGL" class="form-label">Tgl</label>
                                </div>
                                
								<div class="col-md-2">
 
								  <input class="form-control date" id="TGL" name="TGL" data-date-format="dd-mm-yyyy" type="text" autocomplete="off" value="{{date('d-m-Y',strtotime($header->TGL))}}">
								
								</div>		
								
                            </div>
        
							<div class="form-group row">							
								<div class="col-md-1">
                                    <label for="KET" class="form-label">Notes</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control KET" id="KET"name="KET"
                                    placeholder="Masukkan Notes" value="{{$header->KET}}" >
                                </div>
							</div>
							
							<hr style="margin-top: 30px; margin-buttom: 30px">
							
							<!-- scroll samping&bawah -->
							
							<!-- <div style="overflow-y:scroll; height:200px;" class="col-md-12 scrollable" align="right"> -->
							<div style="overflow-y:scroll;" class="col-md-12 scrollable" align="right">
							
								<!-- <table id="datatable" class="table table-striped table-border table-scrollable"> -->
								<table id="datatable" class="table table-striped table-border">
								
							<!-- batas scroll --> 
							
                                <thead>
                                    <tr>
										<th width="100px">No.</th>
                                        <th width="200px">
											<label style="color:red;font-size:20px">* </label>									
                                            <label for="BACNO" class="form-label">AccountA#</label></th>
                                        <th width="200px">-</th>
                                        <th width="200px">
								        	<label style="color:red;font-size:20px">* </label>									
                                            <label for="BACNO1" class="form-label">AccountB#</label></th>	
                                        <th width="200px">-</th>
                                        <th width="600px">Uraian</th>
                                        <th width="200px">Jumlah</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
								<?php $no=0 ?>
								@foreach ($detail as $detail)
                                    <tr>
                                         <td>
                                            <input type="hidden" name="NO_ID[]" id="NO_ID{{$no}}" type="text" value="{{$detail->NO_ID}}" 
                                            class="form-control NO_ID" onkeypress="return tabE(this,event)" readonly>
                                            
                                            <input name="REC[]" id="REC{{$no}}" type="text" value="{{$detail->REC}}" 
                                            class="form-control REC" onkeypress="return tabE(this,event)" readonly>
                                        </td>
                                        <td>
                                            <input name="ACNO[]"  data-rowid={{$no}} id="ACNO{{$no}}" type="text" value="{{$detail->ACNO}}"
                                            class="form-control ACNO" readonly required>
                                        </td>

                                        <td>
                                            <input name="NACNO[]" id="NACNO{{$no}}" type="text" value="{{$detail->NACNO}}"
                                            class="form-control NACNO" readonly required>
                                        </td>
                                        <td>
                                            <input name="ACNOB[]" id="ACNOB{{$no}}" type="text" value="{{$detail->ACNOB}}"
                                            class="form-control ACNOB" readonly required>
                                        </td>

                                        <td>
                                            <input name="NACNOB[]" id="NACNOB{{$no}}" type="text" value="{{$detail->NACNOB}}"
                                            class="form-control NACNOB" readonly required>
                                        </td>										
										<td>
                                            <input name="URAIAN[]" id="URAIAN{{$no}}" type="text" value="{{$detail->URAIAN}}"
                                            class="form-control URAIAN" required>
                                        </td>
										<td>
                                            <input name="JUMLAH[]" onclick="select()" onkeyup="hitung()" id="JUMLAH{{$no}}" type="text" value="{{$detail->JUMLAH}}"
                                            class="form-control JUMLAH" style="text-align: right"  required>
                                        </td>
                                        
										<td>
                                            <button type="button" id="DELETEX{{$no}}" class="btn btn-sm btn-circle btn-outline-danger btn-delete" onclick="">
                                                <i class="fa fa-fw fa-trash"></i>
                                            </button>
                                        </td>
                                        
                                    </tr>
								<?php $no++; ?>	
								@endforeach
									
									
                                </tbody>
								<tfoot>
								
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>								
                                    <td><input class="form-control TJUMLAH text-primary font-weight-bold" style="text-align: right"  id="TJUMLAH" name="TJUMLAH" value="{{$header->JUMLAH}}" readonly></td>
                                </tfoot>
                            </table>
							
					<!-- nambah div ini -->						
						</div>
					<!-- batas div -->    
						
                            <div class="col-md-2 row">
                               <a type="button" id='PLUSX' onclick="tambah()" class="fas fa-plus fa-sm md-3" ></a>					
							</div>		
                            
                           
                        </div>
        
						<div class="mt-3 col-md-12 form-group row">
							<div class="col-md-4">
							<!--	<button type="button" id='TOPX'  onclick="location.href='{{url('/memo/edit/?idx=' .$idx. '&tipx=top&flagz='.$flagz.'' )}}'" class="btn 	btn-outline-primary">Top</button>
								<button type="button" id='PREVX' onclick="location.href='{{url('/memo/edit/?idx='.$header->NO_ID.'&tipx=prev&flagz='.$flagz.'&buktix='.$header->NO_BUKTI )}}'" class="btn btn-outline-primary">Prev</button>
								<button type="button" id='NEXTX' onclick="location.href='{{url('/memo/edit/?idx='.$header->NO_ID.'&tipx=next&flagz='.$flagz.'&buktix='.$header->NO_BUKTI )}}'" class="btn btn-outline-primary">Next</button>
								<button type="button" id='BOTTOMX' onclick="location.href='{{url('/memo/edit/?idx=' .$idx. '&tipx=bottom&flagz='.$flagz.'' )}}'" class="btn btn-outline-primary">Bottom</button>
							-->
								
								<button type="button" id='TOPX'  onclick="location.href='{{url('/memo/edit/?idx=' .$idx)}}'" class="btn btn-outline-primary">Top</button>
								<button type="button" id='PREVX' onclick="location.href='{{url('/memo/edit/?idx='.$header->NO_ID.'&buktix='.$header->NO_BUKTI )}}'" class="btn btn-outline-primary">Prev</button>
								<button type="button" id='NEXTX' onclick="location.href='{{url('/memo/edit/?idx='.$header->NO_ID.'&buktix='.$header->NO_BUKTI )}}'" class="btn btn-outline-primary">Next</button>
								<button type="button" id='BOTTOMX' onclick="location.href='{{url('/memo/edit/?idx=' .$idx )}}'" class="btn btn-outline-primary">Bottom</button>
							</div>
							<div class="col-md-5">
							<!--	<button type="button" id='NEWX' onclick="location.href='{{url('/memo/edit/?idx=0&tipx=new&flagz='.$flagz.'' )}}'" class="btn btn-warning">New</button>
								<button type="button" id='EDITX' onclick='hidup()' class="btn btn-secondary">Edit</button>                    
								<button type="button" id='UNDOX' onclick="location.href='{{url('/memo/edit/?idx=' .$idx. '&tipx=undo&flagz='.$flagz.'' )}}'" class="btn btn-info">Undo</button>  
								<button type="button" id='SAVEX' onclick='simpan()'   class="btn btn-success"<i class="fa fa-save"></i>Save</button>
							-->
								
								<button type="button" id='NEWX' onclick="location.href='{{url('/memo/edit/?idx=0' )}}'" class="btn btn-warning">New</button>
								<button type="button" id='EDITX' onclick='hidup()' class="btn btn-secondary">Edit</button>                    
								<button type="button" id='UNDOX' onclick="location.href='{{url('/memo/edit/?idx=' .$idx)}}'" class="btn btn-info">Undo</button>  
								<button type="button" id='SAVEX' onclick='simpan()'   class="btn btn-success"<i class="fa fa-save"></i>Save</button>

							</div>
							<div class="col-md-3">
								<button type="button" id='HAPUSX'  onclick="hapusTrans()" class="btn btn-outline-danger">Hapus</button>
							<!--
								<button type="button" id='CLOSEX'  onclick="location.href='{{url('/memo?flagz='.$flagz.'' )}}'" class="btn btn-outline-secondary">Close</button>
							-->	
								<button type="button" id='CLOSEX'  onclick="location.href='{{url('/memo/edit' )}}'" class="btn btn-outline-secondary">Close</button>

							</div>
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

	
	<div class="modal fade" id="browseAccount1Modal" tabindex="-1" role="dialog" aria-labelledby="browseAccount1ModalLabel" aria-hidden="true">
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
	

@endsection
@section('footer-scripts')
<!-- TAMBAH 1 -->
<script src="{{ asset('js/autoNumerics/autoNumeric.min.js') }}"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script> -->
<script src="{{asset('foxie_js_css/bootstrap.bundle.min.js')}}"></script>

<script>

	var idrow = 1;
	var baris = 1;
    function numberWithCommas(x) {
		return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
	}

// TAMBAH HITUNG
	$(document).ready(function() {

		idrow=<?php echo $no; ?>;
		baris=<?php echo $no; ?>;
		$("#TJUMLAH").autoNumeric('init', {aSign: '<?php echo ''; ?>',vMin: '-999999999.99'});

		jumlahdata = 100;
		
		for (i = 0; i <= jumlahdata; i++) {
			$("#JUMLAH" + i.toString()).autoNumeric('init', {aSign: '<?php echo ''; ?>', vMin: '-999999999.99'});
		}


		$tipx = $('#tipx').val();
		
		
        if ( $tipx == 'new' )
		{
			 baru();			
		}

        if ( $tipx != 'new' )
		{
			 ganti();			
		}    
		
		
				
		$(".ACNO").each(function() {
			var getid = $(this).attr('id');
			var noid = getid.substring(4,11);
            
			
			
			$("#ACNO"+noid).keypress(function(e){
				if(e.keyCode == 46){
					e.preventDefault();
					browseAccount(noid);
				}
			}); 
		});
		
		$(".ACNOB").each(function() {
			var getid = $(this).attr('id');
			var noid = getid.substring(5,11);
              
			
			$("#ACNOB"+noid).keypress(function(e){
				if(e.keyCode == 46){
					e.preventDefault();
					browseAccount1(noid);
				}
			}); 
		});
		
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
		
		
	

		
//////////////////////////////////////////////////////////////////////
		
 		var dTableBAccount;
		var rowidAccount;
		loadDataBAccount = function(){
			$.ajax(
			{
				type: 'GET',    
				url: "{{url('account/browse')}}",
				success: function( response )
				{
					resp = response;
					if(dTableBAccount){
						dTableBAccount.clear();
					}
					for(i=0; i<resp.length; i++){
						
						dTableBAccount.row.add([
							'<a href="javascript:void(0);" onclick="chooseAccount(\''+resp[i].ACNO+'\',\''+resp[i].NAMA+'\')">'+resp[i].ACNO+'</a>',
							resp[i].NAMA,
						]);
					}
					dTableBAccount.draw();
				}
			});
		}
		
		dTableBAccount = $("#table-baccount").DataTable({
			
		});

		
		browseAccount = function(rid){
		
			rowidAccount = rid;
			loadDataBAccount();
			$("#browseAccountModal").modal("show");
		}
		
		chooseAccount = function(ACNO,NAMA){
			$("#ACNO"+rowidAccount).val(ACNO);
			$("#NACNO"+rowidAccount).val(NAMA);
			$("#browseAccountModal").modal("hide");
		}
		
		
		$("#ACNO0").keypress(function(e){
			if(e.keyCode == 46){
				e.preventDefault();
				browseAccount(0);
			}
		}); 



//////////////////////////////////////////////////////////////////


        var dTableBAccount1;
		var rowidAccount1;
		loadDataBAccount1 = function(){
			$.ajax(
			{
				type: 'GET',    
				url: "{{url('account/browse')}}",
				success: function( response )
				{
					resp = response;
					if(dTableBAccount1){
						dTableBAccount1.clear();
					}
					for(i=0; i<resp.length; i++){
						
						dTableBAccount1.row.add([
							'<a href="javascript:void(0);" onclick="chooseAccount1(\''+resp[i].ACNO+'\',\''+resp[i].NAMA+'\')">'+resp[i].ACNO+'</a>',
							resp[i].NAMA,
						]);
					}
					dTableBAccount1.draw();
				}
			});
		}


		dTableBAccount1 = $("#table-baccount1").DataTable({
			
		});
		
		browseAccount1 = function(rid){
			rowidAccount1 = rid;
			loadDataBAccount1();
			$("#browseAccount1Modal").modal("show");
		}
		
		chooseAccount1 = function(ACNO,NAMA){
			$("#ACNOB"+rowidAccount1).val(ACNO);
			$("#NACNOB"+rowidAccount1).val(NAMA);
			$("#browseAccount1Modal").modal("hide");
		}
		
		
		$("#ACNOB0").keypress(function(e){
			if(e.keyCode == 46){
				e.preventDefault();
				browseAccount1(0);
			}
		}); 
		
		
	});
//////////////////////////////////////////////////////////////////



//////////////////////////////////////////////////////////////////

function cekDetail(){
		var cekAcno = '';
		$(".ACNO").each(function() {
			
			let z = $(this).closest('tr');
			var ACNOX = z.find('.ACNO').val();
			var ACNOBX = z.find('.ACNOB').val();
						
			if( ACNOX =="" )
			{
					cekAcno = '1';
					
			}

			if( ACNOBX =="" )
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
                    alert("Bank Harus diisi.");
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
			if(isNaN(val)) val = 0;
			TJUMLAH+=val;
		});
		

		if(isNaN(TJUMLAH)) TJUMLAH = 0;

		$('#TJUMLAH').val(numberWithCommas(TJUMLAH));
		$("#TJUMLAH").autoNumeric('update');

	}

		$(".ACNO").keypress(function(e){
			if(e.keyCode == 46){
				e.preventDefault();
				browseAccount(eval($(this).data("rowid")));
			}
		});


	function baru() {
		
		 kosong();
		 hidup();
	
	}
	
	function ganti() {
		
		 mati();
	
	}
	
	function batal() {
		
		// alert($header[0]->NO_BUKTI);
		
		 //$('#NO_BUKTI').val($header[0]->NO_BUKTI);	
		 mati();
	
	}
	
 

	
	
	function hidup() {

		
		$("#TOPX").attr("disabled", true);
	    $("#PREVX").attr("disabled", true);
	    $("#NEXTX").attr("disabled", true);
	    $("#BOTTOMX").attr("disabled", true);

	    $("#NEWX").attr("disabled", true);
	    $("#EDITX").attr("disabled", true);
	    $("#UNDOX").attr("disabled", false);
	    $("#SAVEX").attr("disabled", false);
		
	    $("#HAPUSX").attr("disabled", true);
	    $("#CLOSEX").attr("disabled", true);
		

		$("#CARI").attr("readonly", true);	
	    $("#SEARCHX").attr("disabled", true);		

		$("#CARI").attr("readonly", false);	
	    $("#SEARCHX").attr("disabled", false);
		
	    $("#PLUSX").attr("hidden", false)
		
			   
		$("#NO_BUKTI").attr("readonly", true);   
		$("#TGL").attr("readonly", false);
		$("#KET").attr("readonly", false);
	

		jumlahdata = 100;
		for (i = 0; i <= jumlahdata; i++) {
			$("#REC" + i.toString()).attr("readonly", true);
			$("#ACNO" + i.toString()).attr("readonly", true);
			$("#NACNO" + i.toString()).attr("readonly", true);
			$("#URAIAN" + i.toString()).attr("readonly", false);
			$("#JUMLAH" + i.toString()).attr("readonly", false);
			$("#DELETEX" + i.toString()).attr("hidden", false);
		}

		
	}


	function mati() {

		
	    $("#TOPX").attr("disabled", false);
	    $("#PREVX").attr("disabled", false);
	    $("#NEXTX").attr("disabled", false);
	    $("#BOTTOMX").attr("disabled", false);


	    $("#NEWX").attr("disabled", false);
	    $("#EDITX").attr("disabled", false);
	    $("#UNDOX").attr("disabled", true);
	    $("#SAVEX").attr("disabled", true);
	    $("#HAPUSX").attr("disabled", false);
	    $("#CLOSEX").attr("disabled", false);
		
		$("#CARI").attr("readonly", false);	
	    $("#SEARCHX").attr("disabled", false);
		
	    $("#PLUSX").attr("hidden", true)
		
	    $(".NO_BUKTI").attr("readonly", true);	
		
		$("#TGL").attr("readonly", true);
		$("#KET").attr("readonly", true);
			
		
		
		jumlahdata = 100;
		for (i = 0; i <= jumlahdata; i++) {
			$("#REC" + i.toString()).attr("readonly", true);
			$("#ACNO" + i.toString()).attr("readonly", true);
			$("#NACNO" + i.toString()).attr("readonly", true);
			$("#URAIAN" + i.toString()).attr("readonly", true);
			$("#JUMLAH" + i.toString()).attr("readonly", true);
			$("#DELETEX" + i.toString()).attr("hidden", true);
			
		}


		
	}


	function kosong() {
				
		 $('#NO_BUKTI').val("+");			
		 $('#KET').val("");	

		 
		var html = '';
		$('#detailx').html(html);	
		
	}
	
	function hapusTrans() {
		let text = "Hapus Transaksi "+$('#NO_BUKTI').val()+"?";
		if (confirm(text) == true) 
		{
			//window.location ="{{url('/memo/delete/'.$header->NO_ID .'/?flagz='.$flagz.'' )}}";
			window.location ="{{url('/memo/delete/'.$header->NO_ID )}}";
			//return true;
		} 
		return false;
	}

	function CariBukti() {
		
		var flagz = "{{ $flagz }}";
		var cari = $("#CARI").val();
		var loc = "{{ url('/memo/edit/') }}" + '?idx={{ $header->NO_ID}}&tipx=search&flagz=' + encodeURIComponent(flagz) + '&buktix=' +encodeURIComponent(cari);
		//var loc = "{{ url('/memo/edit/') }}" + '?idx={{ $header->NO_ID}}&tipx=search + '&buktix=' +encodeURIComponent(cari);
		window.location = loc;
		
	}


    function tambah() {

        var x = document.getElementById('datatable').insertRow(baris + 1);
      
	  html=`<tr>

                <td>
 					<input name='NO_ID[]' id='NO_ID${idrow}' type='hidden' class='form-control NO_ID' value='new' readonly> 
					<input name='REC[]' id='REC${idrow}' type='text' class='REC form-control' onkeypress='return tabE(this,event)' readonly>
	            </td>
						       
                <td>
				    <input name='ACNO[]' data-rowid=${idrow}  id='ACNO${idrow}' type='text' class='form-control  ACNO' required readonly>
                </td>
                <td>
				    <input name='NACNO[]'   id='NACNO${idrow}' type='text' class='form-control  NACNO' required readonly>
                </td>
				
                <td>
				    <input name='ACNOB[]' data-rowid=${idrow}  id='ACNOB${idrow}' type='text' class='form-control  ACNOB' required readonly>
                </td>
                <td>
				    <input name='NACNOB[]'   id='NACNOB${idrow}' type='text' class='form-control  NACNOB' required readonly>
                </td>
				
                <td>
				    <input name='URAIAN[]'   id='URAIAN${idrow}' type='text' class='form-control  URAIAN' required>
                </td>
				
				<td>
		            <input name='JUMLAH[]'  onblur='hitung()' value='0' id='JUMLAH${idrow}' type='text' style='text-align: right' class='form-control JUMLAH text-primary' required >
                </td>

                <td>
					<button type='button' id='DELETEX${idrow}'  class='btn btn-sm btn-circle btn-outline-danger btn-delete' onclick=''> <i class='fa fa-fw fa-trash'></i> </button>
                </td>				
         </tr>`;
				
        x.innerHTML = html;
        var html='';
	  
	  
	  
		jumlahdata = 100;
		for (i = 0; i <= jumlahdata; i++) {
			$("#JUMLAH" + i.toString()).autoNumeric('init', {aSign: '<?php echo ''; ?>', vMin: '-999999999.99'});
		}
		
		$("#ACNO"+idrow).keypress(function(e){
			if(e.keyCode == 46){
				e.preventDefault();
				browseAccount(eval($(this).data("rowid")));
			}
		}); 

		$("#ACNOB"+idrow).keypress(function(e){
			if(e.keyCode == 46){
				e.preventDefault();
				browseAccount1(eval($(this).data("rowid")));
			}
		}); 
		

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
