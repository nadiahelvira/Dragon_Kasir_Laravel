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
            <h1 class="m-0">Edit Data Aktiva {{$KODE}} - {{$NAMA}}</h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{url('/aktiva')}}">Master Aktiva</a></li>
                <li class="breadcrumb-item active">Edit {{$KODE}}</li>
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
                    <form action="{{url('/aktiva/update/'.$NO_ID)}}" method="POST" id="entri">
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
                                    <label for="KODE" class="form-label">Kode Aktiva</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control KODE" id="KODE" name="KODE"
                                    placeholder="Masukkan Kode Aktiva" value="{{$KODE}}" readonly>
                                </div>
                            </div>
        
                            <div class="form-group row">
                                <div class="col-md-2">
                                    <label for="NAMA" class="form-label">Nama Aktiva</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control NAMA" id="NAMA" name="NAMA"
                                    placeholder="Masukkan Nama Aktiva" value="{{$NAMA}}" >
                                </div>
                            </div>
							
                            <div class="form-group row">
                                <div class="col-md-2">
                                    <label for="SATUAN" class="form-label">Satuan</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control SATUAN" id="SATUAN" name="SATUAN"
                                    placeholder="Masukkan Satuan" value="{{$SATUAN}}">
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
@endsection
@section('footer-scripts')
<script src="{{ asset('js/autoNumerics/autoNumeric.min.js') }}"></script>
<!--<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script> -->
<script src="{{asset('foxie_js_css/bootstrap.bundle.min.js')}}"></script>
<script>
    var target;
	var idrow = 1;

	function numberWithCommas(x) {
		return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
	}


    $(document).ready(function () {
		
	//	$("#HBELI").autoNumeric('init', {aSign: '<?php echo ''; ?>',vMin: '-999999999.99'});
		
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
	function cekAktiva(kodeakt) {
		$.ajax({
			type: "GET",
			url: "{{url('aktiva/cekaktiva')}}",
            async: false,
			data: ({ KODEAKT: kodeakt, }),
			success: function(data) {
                // hasilCek=data;
                if (data.length > 0) {
                    $.each(data, function(i, item) {
                        hasilCek=data[i].ADA;
                    });
                }
			},
			error: function() {
				alert('Error cekAktiva occured');
			}
		});
		return hasilCek;
	}
    
	function simpan() {
        //cekAktiva($('#KODE').val());
        //(hasilCek==0) ? document.getElementById("entri").submit() : alert('Kode Aktiva '+$('#KODE').val()+' sudah ada!');
        
        document.getElementById("entri").submit()
	}
</script>
@endsection