@extends('layouts.main')
@section('styles')
<!-- <link rel="stylesheet" href="{{url('http://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css') }}"> -->
<link rel="stylesheet" href="{{asset('foxie_js_css/jquery.dataTables.min.css')}}" />

@endsection


<style>
    .card-body {
        padding: 5px 10px !important;
    }

    .table thead {
        background-color: #c6e2ff;
        color: #000;
    }

    .datatable tbody td {
        padding: 5px !important;
    }

    .datatable {
        border-right: solid 2px #000;
        border-left: solid 2px #000;
    }

    .table tbody:nth-child(2) {
        background-color: #ffe4e1;
    }

    .btn-secondary {
        background-color: #42047e !important;
    }
    
    th { font-size: 13px; }
    td { font-size: 13px; }
</style>



@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">{{$judul}} </h1>
          </div>
          <!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">{{$judul}} </li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Status -->
    @if (session('status'))
        <div class="alert alert-success">
            {{session('status')}}
        </div>
    @endif

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-body">
			  
                <input name="flagz" class="form-control flagz" id="flagz" value="{{$flagz}}" hidden>               
                <input name="bacnoz" class="form-control bacnoz" id="bacnoz" value="{{$bacnoz}}" hidden>        			 
                
                <table class="table table-fixed table-striped table-border table-hover nowrap datatable" id="datatable">
                    <thead class="table-dark">
                        <tr>
											
                            <th scope="col" style="text-align: center">No</th>
				     		            <th scope="col" style="text-align: center">-</th>							
                            <th scope="col" style="text-align: left">No Bukti</th>
                            <th scope="col" style="text-align: left">Tgl</th>
                            <th scope="col" style="text-align: left">Bank#</th>
                            <th scope="col" style="text-align: left">-</th>
                            <th scope="col" style="text-align: right">Jumlah</th>
                            <th scope="col" style="text-align: center">Posted</th>
                            <th scope="col" style="text-align: center">User</th>
                        </tr>
                    </thead>
    
                     <tbody>
                         
                    </tbody> 
                </table>
              </div>
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
  <div class="modal fade" id="browseBankModal" tabindex="-1" role="dialog" aria-labelledby="browseBankModalLabel" aria-hidden="true">
	  <div class="modal-dialog modal-xl" role="document"> 
  		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title" id="browseBankModalLabel">Cari Bank</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>
		  <div class="modal-body">
			<table class="table table-stripped table-bordered" id="table-bbank">
				<thead>
					<tr>
						<th>Bukti</th>
						<th>Tgl</th>
						<th>Acno</th>
						<th>PB/PN/PBI</th>
						<th>Uraian</th>
						<th>Jumlah</th>
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

@section('javascripts')

<-- tombol cari -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

<script>
  $(document).ready(function() {
        var dataTable = $('.datatable').DataTable({
            processing: true,
            serverSide: true,
            autoWidth: true,
            "order": [[ 0, "asc" ]],
            ajax: 
            {
                url: '{{ route('get-bank') }}',
				data: {
					'flagz': "{{$flagz}}",
					'bacnoz': "{{$bacnoz}}",
				},
            },
            columns: 
            [
                {  data: 'DT_RowIndex', orderable: false, searchable: false },
				
			    {
				data: 'action',
				name: 'action'
			    },
				
                {data: 'NO_BUKTI', name: 'NO_BUKTI'},
                {data: 'TGL', name: 'TGL'},
                {data: 'BACNO', name: 'BACNO'},				
                {data: 'BNAMA', name: 'BNAMA'},
                {
					data: 'JUMLAH', 
					name: 'JUMLAH',
					render: $.fn.dataTable.render.number( ',', '.', 2, '' )
				},
                { data: 'POSTED', name: 'POSTED',
                  render : function(data, type, row, meta) {
                    if(row['POSTED']=="0"){
                        return '';
                    }else{
                        return '<input type="checkbox" checked style="pointer-events: none;">';
                    }
                  }
                },
                { data: 'USRNM_KSR', name: 'USRNM_KSR'},															

				
            ],

            columnDefs: [
                {
                    "className": "dt-center", 
                    "targets": [0,7],
                },			
				{
					targets: 3,
					render: $.fn.dataTable.render.moment( 'DD-MM-YYYY' )
				},
				{
                    "className": "dt-right", 
                    "targets": 6
                }
            ],
        lengthMenu: [
                [8, 10, 20, 50, 100, -1],
                [8, 10, 20, 50, 100, "All"]
            ],
        dom: "<'row'<'col-md-6'><'col-md-6'>>" +
            "<'row'<'col-md-2'l><'col-md-6 test_btn m-auto'><'col-md-4'f>>" +
            "<'row'<'col-md-12't>><'row'<'col-md-12'ip>>",
			
        });
		
        // $("div.test_btn").html('<a class="btn btn-lg btn-md btn-success" href="{{url('bank/edit?flagz='.$flagz.'&bacnoz='.$bacnoz.'&idx=0&tipx=new')}}"> <i class="fas fa-plus fa-sm md-3" ></i></a');
    
		var dTableBBank;
		loadDataBBank = function(){
			
			$.ajax(
			{
				type: 'GET', 		
				url: '{{url('bank/cari')}}',
                data: {
                  'flagz': "{{$flagz}}",
				  'bacnoz': "{{$bacnoz}}",
                },
				success: function( response )
				{
					resp = response;
					if(dTableBBank){
						dTableBBank.clear();
					}
					for(i=0; i<resp.length; i++){
						
						dTableBBank.row.add([
							resp[i].NO_BUKTI,
							resp[i].TGL,
							resp[i].ACNO,							
							resp[i].NO_HUT,
							resp[i].URAIAN,
							resp[i].JUMLAH,
						]);
					}
					dTableBBank.draw();
				}
			});
		}
		
		dTableBBank = $("#table-bbank").DataTable({
			
		});
		
		browseBank = function(){
			loadDataBBank();
			$("#browseBankModal").modal("show");
		}
		
		$("div.test_btn").html('<a class="btn btn-lg btn-md btn-success" href="{{url('bank/edit?flagz='.$flagz.'&bacnoz='.$bacnoz.'&idx=0&tipx=new')}}"> <i class="fas fa-plus fa-sm md-3" > TAMBAH BARU </i></a>'+ 
		'<a></a> <a class="btn btn-lg btn-md btn-success" onclick="browseBank()"></i> Cari </a>');
	
	
	
	
	
	});
	
</script>
@endsection
