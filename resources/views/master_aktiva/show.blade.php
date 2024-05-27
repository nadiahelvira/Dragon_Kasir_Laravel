@extends('layouts.main')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">Lihat Data Barang</h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{url('brg')}}">Master Barang</a></li>
                <li class="breadcrumb-item active">{{$KD_BRG}}</li>
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
                    <form action="store" method="POST">
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
                                    <label for="KD_BRG" class="form-label">Kode Barang</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control KD_BRG" id="KD_BRG" name="KD_BRG"
                                    placeholder="Masukkan Kode Barang" value="{{$KD_BRG}}" readonly>
                                </div>                          
                            </div>
 
						<div class="form-group row">
                                <div class="col-md-2">
                                    <label for="NA_BRG" class="form-label">Nama Barang</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control NA_BRG" id="NA_BRG" name="NA_BRG"
                                    placeholder="Masukkan Nama Barang" value="{{$NA_BRG}}" readonly>
                                </div>                          
                            </div>

						<div class="form-group row">
                                <div class="col-md-2">
                                    <label for="Gol" class="form-label">Gol</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control GOL" id="GOL" name="GOL"
                                    placeholder="Masukkan Gol" value="{{$GOL}}" readonly>
                                </div>                          
                            </div>
 
                            <div class="form-group row">
                                <div class="col-md-2">
                                    <label for="SATUAN" class="form-label">Satuan</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control SATUAN" id="SATUAN" name="SATUAN"
                                    placeholder="Masukkan Satuan" value="{{$SATUAN}}" readonly>
                                </div>        
                            </div>
        
 
 
        
                            <hr style="margin-top: 30px; margin-buttom: 30px">
                            
                        </div>
        
                        {{-- <div class="mt-3">
                            <button type="submit"  class="btn btn-success"><i class="fa fa-save"></i> Save</button>										
                            <a type="button" href="javascript:javascript:history.go(-1)" class="btn btn-danger">Cancel</a>
                        </div> --}}
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
</script>
@endsection

