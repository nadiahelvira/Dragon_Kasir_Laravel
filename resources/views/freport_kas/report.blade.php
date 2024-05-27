@extends('layouts.main')
<style>
    .bigdrop {
        width: 410px !important;
    }
</style>
@section('content')
<div class="content-wrapper">
	<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
		<div class="col-sm-6">
			<h1 class="m-0">Laporan Jurnal Kas</h1>
		</div>
		<div class="col-sm-6">
			<ol class="breadcrumb float-sm-right">
			<li class="breadcrumb-item active">Laporan Jurnal Kas</li>
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
					<form method="POST" action="{{url('rkas/jasper-kas-report')}}">
					@csrf

					<div class="form-group row">
							<div class="col-md-1">
								<label for="TYPE" class="form-label" >Jenis Kas</label>
							</div>
							<div class="col-md-2">
								<select name="TYPE" id="TYPE" class="form-control TYPE" style="width: 200px">
									<option value="-">Semua</option>
									<option value="BKM" {{ ( session()->get('filter_type') == 'BKM') ? 'selected' : '' }}   >Masuk</option>
									<option value="BKK" {{ ( session()->get('filter_type') == 'BKK') ? 'selected' : '' }} >Keluar</option>
								</select>
							</div>

							<!-- <div class="col-md-1">
							<label for="ACNO" class="form-label">Pilih Acno</label>
							</div>
							<div class="col-md-2">
								<select name="ACNO" id="ACNO" class="form-control ACNO" style="width: 200px">
									<option value="">--Pilih Account--</option>
									@foreach($acno as $acno)
										<option value="{{$acno->ACNO}}" {{ (session()->get('filter_acno1') == $acno->ACNO ) ? 'selected' : '' }} > {{$acno->ACNO}} - {{$acno->NAMA}} </option>

									@endforeach
								</select>
							</div> -->
                    </div>

					<!-- Filter No Bukti -->
						<div class="form-group row">
							<div class="col-md-1" align="left"><strong style="font-size: 13px;">Bukti#</strong></div>
							<div class="col-md-2">
								<input type="text" class="form-control nobukti1" id="nobukti1" name="nobukti1" placeholder="" value="{{ session()->get('filter_nobukti1') }}" onblur="isi_sampai()" >
							</div>
							<div class="col-md-1" align="left"><strong style="font-size: 13px;">s.d</strong></div>
							<div class="col-md-2">
								<input type="text" class="form-control nobukti2" id="nobukti2" name="nobukti2" placeholder="ZZZ" value="{{ session()->get('filter_nobukti2') }}">
							</div>

							<div class="col-md-1" align="left"><strong style="font-size: 13px;">Jenis Laporan</strong></div>
							<div class="col-md-2">
								<select name="PILIH" id="PILIH" class="form-control PILIH" style="width: 200px">
									<option value="1" {{ ( session()->get('filter_pilih') == '1') ? 'selected' : '' }} >Journal Kas</option>
									<option value="2" {{ ( session()->get('filter_pilih') == '2') ? 'selected' : '' }} >Kas Pendek Per Bukti</option>
									<option value="3" {{ ( session()->get('filter_pilih') == '3') ? 'selected' : '' }} >Kas Per Nomer Bukti</option>
								</select>
							</div>
						</div>
					
					<!-- Filter Tanggal -->
					<div class="form-group row">
						<div class="col-md-1" align="left"><strong style="font-size: 13px;">Tgl</strong></div>
						<div class="col-md-2">
							<input class="form-control date tglDr" id="tglDr" name="tglDr"
							type="text" autocomplete="off" value="{{ session()->get('filter_tglDari') }}"> 
						</div>
						<div class="col-md-1" align="left"><strong style="font-size: 13px;">s.d</strong></div>
						<div class="col-md-2">
							<input class="form-control date tglSmp" id="tglSmp" name="tglSmp"
							type="text" autocomplete="off" value="{{ session()->get('filter_tglSampai') }}">
						</div>
					</div>

					<!-- <div class="form-group row">
						<div class="col-md-1">
							<label for="URAIAN" class="form-label">Uraian</label>
						</div>
						<div class="col-md-3">
							<input type="text" class="form-control URAIAN" id="URAIAN" name="URAIAN" placeholder="Uraian" value="">
						</div>
					</div> -->

					 
						<button class="btn btn-primary" type="submit" id="filter" class="filter" name="filter">Filter</button>
						<button class="btn btn-danger" type="button" id="resetfilter" class="resetfilter" onclick="window.location='{{url("rkas")}}'">Reset</button>
						<button class="btn btn-warning" type="submit" id="cetak" class="cetak" formtarget="_blank">Cetak</button>
						</form>
						<div style="margin-bottom: 15px;"></div>
					
					<div class="report-content" col-md-12>
					<?php
					use \koolreport\datagrid\DataTables;

					if($hasil)
					{
						DataTables::create(array(
							"dataSource" => $hasil,
							"name" => "example",
							"fastRender" => true,
							"fixedHeader" => true,
							'scrollX' => true,
							"showFooter" => true,
							"showFooter" => "bottom",
							"columns" => array(
								"NO_BUKTI" => array(
									"label" => "Bukti#",
								),
								"TGL" => array(
									"label" => "Tanggal",
								),
								"BACNO" => array(
									"label" => "cash#",
								),
								"BNAMA" => array(
									"label" => "-",
								),
								"ACNO" => array(
									"label" => "ACNO#",
								),
								// "NACNO" => array(
								// 	"label" => "-",
								// ),
								"URAIAN" => array(
									"label" => "Uraian",
								),
								"DEBET" => array(
									"label" => "Debet",
									"type" => "number",
									"decimals" => 2,
									"decimalPoint" => ".",
									"thousandSeparator" => ",",
									"footer" => "sum",
									"footerText" => "<b>@value</b>",
								),
								"KREDIT" => array(
									"label" => "Kredit",
									"type" => "number",
									"decimals" => 2,
									"decimalPoint" => ".",
									"thousandSeparator" => ",",
									"footer" => "sum",
									"footerText" => "<b>@value</b>",
								),
								"SALDO" => array(
									"label" => "Saldo",
									"type" => "number",
									"decimals" => 2,
									"decimalPoint" => ".",
									"thousandSeparator" => ",",
									"footer" => "sum",
									"footerText" => "<b>@value</b>",
								),
							),
							"cssClass" => array(
                                    "table" => "table table-hover table-striped table-bordered compact",
                                    "th" => "label-title",
                                    "td" => "detail",
                                    "tf" => "footerCss"
                                ),
                                "options" => array(
                                    "columnDefs"=>array(
                                        array(
                                            "className" => "dt-right", 
                                            "targets" => [6,7,8],
                                        ),
                                    ),
                                    "order" => [],
                                    "paging" => true,
                                    // "pageLength" => 12,
									"lengthMenu" => [[10, 25, 50,-1], [10,25,50, "All"]],
                                    "searching" => true,
                                    "colReorder" => true,
                                    "select" => true,
                                    "dom" => 'Blfrtip', // B e dilangi
                                    // "dom" => '<"row"<col-md-6"B><"col-md-6"f>> <"row"<"col-md-12"t>><"row"<"col-md-12">>',
                                    "buttons" => array(
                                        array(
                                            "extend" => 'collection',
                                            "text" => 'Export',
                                            "buttons" => [
                                                'copy',
                                                'csv',
                                                'excel',
                                                'pdf',
                                                'print'
                                            ],
                                        ),
                                    ),
                                ),
                            ));
                        }
                        ?>
                    </div>
                    <!-- DISINI BATAS AKHIR KOOLREPORT-->
					
					</div>
				</div>
				</div>
			</div>
			</div>
		</div>
	</div>
	@endsection

	@section('javascripts')
	<script>
		$(document).ready(function() {
			$('.date').datepicker({  
				dateFormat: 'dd-mm-yy'
			}); 

		});
		
		function isi_sampai()
		{
		   // alert('halo');
			
			var DARIX = $('#nobukti1').val();
			var SAMPAIX = $('#nobukti2').val();
			
			if ( SAMPAIX =='ZZZ' )
			{
    
	            $('#nobukti2').val(DARIX);
				
            }	
			
		   
		}
		
	</script>
	@endsection
