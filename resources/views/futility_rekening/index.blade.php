@extends('layouts.main')
@section('styles')
<!-- DataTables -->
<link rel="stylesheet" href="{{url('AdminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
<link rel="stylesheet" href="{{url('http://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css') }}">
@endsection
 
<style>  
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
 
 <!--// ganti 1 -->
 
		<h1 class="m-0">Master Account</h1>
          </div>
          <!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
 <!--// ganti 2 -->

              <li class="breadcrumb-item active">Master Account</li>
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
			  
 <!--// ganti 6 -->	
 
                <a class="btn  btn-md btn-success" href="{{url('account/create')}}" style="padding-top: 0px; padding-bottom: 0px; padding-right: 8px; padding-left: 8px; font-size: 18px;">
                    <i class="far fa-plus-square fa-sm md-3"></i>
                    {{-- <i class="fas fa-plus fa-sm md-3" ></i> --}}
                </a>
                
                <table class="table table-fixed table-striped table-border table-hover nowrap datatable" id="datatable">
                    <thead class="table-dark">
                        <tr>
 <!--// ganti 7 -->											
                            <th scope="col" style="text-align: center">No</th>
				     		<th scope="col" style="text-align: center">-</th>							
                            <th scope="col" style="text-align: center">Account</th>
                            <th scope="col" style="text-align: center">Nama</th>
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
@endsection

@section('javascripts')
<script src="{{url('AdminLTE/plugins/datatables/jquery.dataTables.js') }}"></script>
<script src="{{url('AdminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
<script src="{{url('http://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js') }}"></script>

<script>
  $(document).ready(function() {
        var dataTable = $('.datatable').DataTable({
            processing: true,
            serverSide: true,
            autoWidth: true,
            'scrollY': '400px',
            "order": [[ 0, "asc" ]],
            ajax: 
            {
				
 <!--// ganti 7b -->
 
                url: '{{ route('get-account') }}'
            },
            columns: 
            [
                {  data: 'DT_RowIndex', orderable: false, searchable: false },

 <!--// ganti 8 -->
			    {
				data: 'action',
				name: 'action'
			    },
				
				{data: 'ACNO', name: 'ACNO'},
                {data: 'NAMA', name: 'NAMA'}			

				
            ],

            columnDefs: [
                {
                    "className": "dt-center", 
                    "targets": 0
                }
            ],
        });
    });
</script>
@endsection
