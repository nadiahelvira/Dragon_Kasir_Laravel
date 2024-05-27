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
               <h1 class="m-0">Edit No Rekening Supplier  {{$KODES}}</h1>	
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{url('/sup')}}">No Rekening Supplier</a></li>
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
						
                        <!-- <ul class="nav nav-tabs">
                            <li class="nav-item active">
                                <a class="nav-link active" href="#suppInfo" data-toggle="tab">Main</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#contactInfo" data-toggle="tab">Contact Person</a>
                            </li>
							<li class="nav-item">
                                <a class="nav-link" href="#deliveryInfo" data-toggle="tab">Lead Delivery Time</a>
                            </li>
							<li class="nav-item">
                                <a class="nav-link" href="#standartInfo" data-toggle="tab">Standart Kualitas</a>
                            </li>
							<li class="nav-item">
                                <a class="nav-link" href="#nilaiInfo" data-toggle="tab">Penilaian</a>
                            </li>
                        </ul> -->
        
                        <div class="tab-content mt-3">
							<div id="suppInfo" class="tab-pane active">
							
                            <div class="form-group row">
                                <div class="col-md-1">
                                    <label for="KODES" class="form-label">Kode</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control KODES" id="KODES" name="KODES"
                                    placeholder="Masukkan Kode Suplier" value="{{$KODES}}" readonly>
                                </div>
                                
                                <div class="col-md-1">
                                    <label for="NAMAS" class="form-label">Nama</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control NAMAS" id="NAMAS" name="NAMAS"
                                    placeholder="Masukkan Nama Suplier" value="{{$NAMAS}}">
                                </div>
                            </div>

							<div class="form-group row">
                                    <div class="col-md-1">
                                        <label for="NOREK" class="form-label">Rekening</label>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control NOREK" id="NOREK" name="NOREK" placeholder="" value="{{$NOREK}}">
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

