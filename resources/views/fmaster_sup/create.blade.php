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
            <h1 class="m-0">Tambah Data Suplier Bahan</h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/sup_bh">Master Suplier Bahan</a></li>
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
                    <form action="store" method="POST" id="entri">
                        @csrf
						
                        <ul class="nav nav-tabs">
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
                        </ul>
        
                        <div class="tab-content mt-3">
							<div id="suppInfo" class="tab-pane active">						
						
                                <div class="form-group row">
                                    <div class="col-md-1">
                                        <label for="KODES" class="form-label">Kode</label>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control KODES" id="KODES" name="KODES"  placeholder="Masukkan Kode Suplier"  >
                                    </div>
                                    <div class="col-md-1">
                                        <label for="NAMAS" class="form-label">Nama</label>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control NAMAS" id="NAMAS" name="NAMAS" placeholder="Masukkan Nama Suplier">
                                    </div>
                                    <div class="col-md-1">
                                        <input type="checkbox" class="form-check-input" id="AKTIF" name="AKTIF" value="1">
                                        <label for="AKTIF">Aktif</label>
                                    </div>
                                    <div class="col-md-1">
                                        <input type="checkbox" class="form-check-input" id="PKP" name="PKP" value="1">
                                        <label for="PKP">PKP</label>
                                    </div>
                                </div>				
                    
                                <div class="form-group row">
                                    <div class="col-md-1">
                                        <label for="ALAMAT" class="form-label">Alamat</label>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control ALAMAT" id="ALAMAT" name="ALAMAT" placeholder="Masukkan Alamat">
                                    </div>
                                    <div class="col-md-1">
                                        <label for="KOTA" class="form-label">Kota</label>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control KOTA" id="KOTA" name="KOTA" placeholder="Masukkan Kota">
                                    </div>								
                                </div>
    
                                <div class="form-group row">      
                                    <div class="col-md-1">
                                        <label for="BERDIRI" class="form-label">Berdiri</label>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control BERDIRI" id="BERDIRI" name="BERDIRI" placeholder="Berdiri Sejak">
                                    </div>
                                    <div class="col-md-1">
                                        <label for="NPWP" class="form-label">NPWP</label>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control NPWP" id="NPWP" name="NPWP" placeholder="Masukkan Kota">
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <div class="col-md-1">
                                        <label for="TELPON1" class="form-label">Telfon</label>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control TELPON1" id="" name="TELPON1" placeholder="Masukkan Telpon">
                                    </div>
                                    <div class="col-md-1">
                                        <label for="FAX" class="form-label">Faximile</label>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control FAX" id="FAX" name="FAX" placeholder="Masukkan Fax">
                                    </div>								
                                </div>
                                
                                <div class="form-group row">
                                    <div class="col-md-1">
                                        <label for="NOREK" class="form-label">No Rekening</label>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control NOREK" id="" name="NOREK" placeholder="Masukkan No Rekening">
                                    </div>
                                    <div class="col-md-1">
                                        <label for="EMAIL" class="form-label">Email/Web</label>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control EMAIL" id="EMAIL" name="EMAIL" placeholder="Masukkan Email/Web">
                                    </div>								
                                </div>
                                
                                <div class="form-group row">
                                    <div class="col-md-1">
                                        <label for="NOTBAY" class="form-label">Pembayaran</label>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control NOTBAY" id="NOTBAY" name="NOTBAY" placeholder="Masukkan Pembayaran">
                                    </div>								
                                </div>
							</div>

							
							<div id="contactInfo" class="tab-pane">

                                <div class="form-group row">
                                    <div class="col-md-1">
                                        <label for="NA_PEMILIK" class="form-label">Pemilik</label>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control NA_PEMILIK" id="NA_PEMILIK" name="NA_PEMILIK" placeholder="Masukkan Nama Pemilik">
                                    </div>
                                    <div class="col-md-1">
                                        <label for="KONTAK" class="form-label">Contant Person</label>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control KONTAK" id="KONTAK" name="KONTAK" placeholder="Masukkan Contact Person">
                                    </div>								
                                </div>
    
                                <div class="form-group row">      
                                    <div class="col-md-1">
                                        <label for="KONTAK_JBTN" class="form-label">Jabatan</label>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control KONTAK_JBTN" id="KONTAK_JBTN" name="KONTAK_JBTN" placeholder="Masukkan Jabatan">
                                    </div>
                                    <div class="col-md-1">
                                        <label for="JENIS_PROD" class="form-label">Jenis Prod</label>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control JENIS_PROD" id="JENIS_PROD" name="JENIS_PROD" placeholder="Masukkan Jenis Prod">
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <div class="col-md-1">
                                        <label for="KONTAK_HP" class="form-label">No HP / C.P</label>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control KONTAK_HP" id="" name="KONTAK_HP" placeholder="Masukkan No HP/CP">
                                    </div>
                                    <div class="col-md-1">
                                        <label for="JUMLAH_KRYWN" class="form-label">Jumlah Karyawan</label>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control JUMLAH_KRYWN" id="JUMLAH_KRYWN" name="JUMLAH_KRYWN" placeholder="Masukkan Jumlah Karyawan">
                                    </div>								
                                </div>
                                
                                <div class="form-group row">
                                    <div class="col-md-1">
                                        <label for="KAP_PROD" class="form-label">Kapasitas</label>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control KAP_PROD" id="" name="KAP_PROD" placeholder="Masukkan Kapasitas">
                                    </div>
                                    <div class="col-md-1">
                                        <label for="HP_PEMILIK" class="form-label">HP Pemilik</label>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control HP_PEMILIK" id="HP_PEMILIK" name="HP_PEMILIK" placeholder="Masukkan No Hp Pemilik">
                                    </div>								
                                </div>
							</div>
							
							<div id="deliveryInfo" class="tab-pane">

                                <div class="form-group row">
                                    <div class="col-md-2">
                                        <label for="LDT_NEW" class="form-label">U/ Barang Baru</label>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" class="form-control LDT_NEW" id="LDT_NEW" name="LDT_NEW" placeholder="">
                                    </div>
                                    <div class="col-md-2">
                                        <label for="LDT_REP" class="form-label">U/ Barang Repeat</label>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" class="form-control LDT_REP" id="LDT_REP" name="LDT_REP" placeholder="">
                                    </div>								
                                </div>
    
                                <div class="form-group row">
                                    <div class="col-md-2">
                                        <label for="PLH" class="form-label">Price Lv. High</label>
                                    </div>
                                    <div class="col-md-2">
                                        <select id="PLH" class="form-control"  name="PLH">
                                            <option value="1" selected>Aktif</option>
                                            <option value="0">Tidak Aktif</option>
                                        </select>
                                    </div>	
                                    <div class="col-md-2">
                                        <label for="PLM" class="form-label">Price Lv. Medium</label>
                                    </div>
                                    <div class="col-md-2">
                                        <select id="PLM" class="form-control"  name="PLM">
                                            <option value="1" selected>Aktif</option>
                                            <option value="0">Tidak Aktif</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="PLL" class="form-label">Price Lv. Low</label>
                                    </div>
                                    <div class="col-md-2">
                                        <select id="PLL" class="form-control"  name="PLL">
                                            <option value="1" selected>Aktif</option>
                                            <option value="0">Tidak Aktif</option>
                                        </select>
                                    </div>
                                </div>
							</div>
							
							<div id="standartInfo" class="tab-pane">

                                <div class="form-group row">
                                    <div class="col-md-2">
                                        <label for="SKH" class="form-label">Standard Qty High</label>
                                    </div>
                                    <div class="col-md-2">
                                        <select id="SKH" class="form-control"  name="SKH">
                                            <option value="1" selected>Aktif</option>
                                            <option value="0">Tidak Aktif</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control SKH_KET" id="SKH_KET" name="SKH_KET" placeholder="">
                                    </div>								
                                </div>
    
                                <div class="form-group row">
                                    <div class="col-md-2">
                                        <label for="SKM" class="form-label">Standard Qty Medium</label>
                                    </div>
                                    <div class="col-md-2">
                                        <select id="SKM" class="form-control"  name="SKM">
                                            <option value="1" selected>Aktif</option>
                                            <option value="0">Tidak Aktif</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control SKM_KET" id="SKM_KET" name="SKM_KET" placeholder="">
                                    </div>								
                                </div>
                                
                                <div class="form-group row">
                                    <div class="col-md-2">
                                        <label for="SKL" class="form-label">Standard Qty Low</label>
                                    </div>
                                    <div class="col-md-2">
                                        <select id="SKL" class="form-control"  name="SKL">
                                            <option value="1" selected>Aktif</option>
                                            <option value="0">Tidak Aktif</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control SKL_KET" id="SKL_KET" name="SKL_KET" placeholder="">
                                    </div>								
                                </div>
                                
                                <div class="form-group row">
                                    <div class="col-md-2">
                                        <label for="KET" class="form-label">Catatan</label>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control KET" id="" name="KET" placeholder="">
                                    </div>						
                                </div>
							</div>
							
							<div id="nilaiInfo" class="tab-pane">

                                <div class="form-group row">
                                    <div class="col-md-2">
                                        <label for="NKUALITAS" class="form-label">Kualitas</label>
                                    </div>
                                    <div class="col-md-1">
                                        <select id="NKUALITAS" class="form-control"  name="NKUALITAS">
                                            <option value="BAIK" selected>Baik</option>
                                            <option value="CUKUP">Cukup</option>
                                            <option value="KURANG">Kurang</option>
                                            <option value="">-</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" class="form-control KUALITAS" id="KUALITAS" name="KUALITAS" placeholder="">
                                    </div>	
                                    <div class="col-md-2">
                                        <label for="NHARGA" class="form-label">Harga</label>
                                    </div>
                                    <div class="col-md-1">
                                        <select id="NHARGA" class="form-control"  name="NHARGA">
                                            <option value="BAIK" selected>Baik</option>
                                            <option value="CUKUP">Cukup</option>
                                            <option value="KURANG">Kurang</option>
                                            <option value="">-</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" class="form-control NOTE_HARGA" id="NOTE_HARGA" name="NOTE_HARGA" placeholder="">
                                    </div>								
                                </div>
    
                                <div class="form-group row">
                                    <div class="col-md-2">
                                        <label for="NPENGIRIMAN" class="form-label">Pengiriman</label>
                                    </div>
                                    <div class="col-md-1">
                                        <select id="NPENGIRIMAN" class="form-control"  name="NPENGIRIMAN">
                                            <option value="BAIK" selected>Baik</option>
                                            <option value="CUKUP">Cukup</option>
                                            <option value="KURANG">Kurang</option>
                                            <option value="">-</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" class="form-control PENGIRIMAN" id="PENGIRIMAN" name="PENGIRIMAN" placeholder="">
                                    </div>	
                                    <div class="col-md-2">
                                        <label for="NKEAMANAN" class="form-label">Keamanan</label>
                                    </div>
                                    <div class="col-md-1">
                                        <select id="NKEAMANAN" class="form-control"  name="NKEAMANAN">
                                            <option value="BAIK" selected>Baik</option>
                                            <option value="CUKUP">Cukup</option>
                                            <option value="KURANG">Kurang</option>
                                            <option value="">-</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" class="form-control KEAMANAN" id="KEAMANAN" name="KEAMANAN" placeholder="">
                                    </div>								
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-2">
                                        <label for="NKREDIT" class="form-label">Kredit</label>
                                    </div>
                                    <div class="col-md-1">
                                        <select id="NKREDIT" class="form-control"  name="NKREDIT">
                                            <option value="BAIK" selected>Baik</option>
                                            <option value="CUKUP">Cukup</option>
                                            <option value="KURANG">Kurang</option>
                                            <option value="">-</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" class="form-control KREDIT" id="KREDIT" name="KREDIT" placeholder="">
                                    </div>	
                                    <div class="col-md-2">
                                        <label for="NPRODUKSI" class="form-label">Produksi</label>
                                    </div>
                                    <div class="col-md-1">
                                        <select id="NPRODUKSI" class="form-control"  name="NPRODUKSI">
                                            <option value="BAIK" selected>Baik</option>
                                            <option value="CUKUP">Cukup</option>
                                            <option value="KURANG">Kurang</option>
                                            <option value="">-</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" class="form-control PRODUKSI" id="PRODUKSI" name="PRODUKSI" placeholder="">
                                    </div>								
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-2">
                                        <label for="NPELAYANAN" class="form-label">Pelayanan</label>
                                    </div>
                                    <div class="col-md-1">
                                        <select id="NPELAYANAN" class="form-control"  name="NPELAYANAN">
                                            <option value="BAIK" selected>Baik</option>
                                            <option value="CUKUP">Cukup</option>
                                            <option value="KURANG">Kurang</option>
                                            <option value="">-</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" class="form-control PELAYANAN" id="PELAYANAN" name="PELAYANAN" placeholder="">
                                    </div>	
                                    <div class="col-md-2">
                                        <label for="NISO" class="form-label">Iso</label>
                                    </div>
                                    <div class="col-md-1">
                                        <select id="NISO" class="form-control"  name="NISO">
                                            <option value="BAIK" selected>Baik</option>
                                            <option value="CUKUP">Cukup</option>
                                            <option value="KURANG">Kurang</option>
                                            <option value="">-</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" class="form-control ISO" id="ISO" name="ISO" placeholder="">
                                    </div>								
                                </div>
                                
                                <div class="form-group row">
                                    <div class="col-md-2">
                                        <label for="NILAI" class="form-label">Nilai Akhir</label>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control NILAI" id="" name="NILAI" placeholder="">
                                    </div>						
                                </div>
                            </div>
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
		var i = 1;
		$(".REC").each(function() {
			$(this).val(i++);
		});
		// hitung();
	}

    function tambah() {

       
     }
     
     
     var hasilCek;
	function cekSup(kodes) {
		
		$.ajax({
			type: "GET",
			url: "{{url('sup_bh/ceksup_bh')}}",
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


