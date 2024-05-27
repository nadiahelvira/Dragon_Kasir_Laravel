	@extends('layouts.main')

	@section('content')
	<div class="content-wrapper">
		<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0">Laporan Mutasi</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
				<li class="breadcrumb-item active">Laporan Mutasi</li>
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
					<form method="POST" action="{{url('rmutasi/jasper-mutasi-report')}}">
						@csrf
					<form id="" name="form" method="post" action="{{ url('rmutasi/cetak') }}">
						<div class="form-group row">
							<div class="col-md-1" align="left"><strong style="font-size: 13px;">Bulan :</strong></div>
							<div class="col-md-2">
								<select name="BULAN" id="BULAN" class="form-control BULAN" style="width: 200px">
									<option value="01" {{ ( session()->get('filter_bulan') == '01') ? 'selected' : '' }} >01</option>
									<option value="02" {{ ( session()->get('filter_bulan') == '02') ? 'selected' : '' }} >02</option>
									<option value="03" {{ ( session()->get('filter_bulan') == '03') ? 'selected' : '' }} >03</option>
									<option value="04" {{ ( session()->get('filter_bulan') == '04') ? 'selected' : '' }} >04</option>
									<option value="05" {{ ( session()->get('filter_bulan') == '05') ? 'selected' : '' }} >05</option>
									<option value="06" {{ ( session()->get('filter_bulan') == '06') ? 'selected' : '' }} >06</option>
									<option value="07" {{ ( session()->get('filter_bulan') == '07') ? 'selected' : '' }} >07</option>
									<option value="08" {{ ( session()->get('filter_bulan') == '08') ? 'selected' : '' }} >08</option>
									<option value="09" {{ ( session()->get('filter_bulan') == '09') ? 'selected' : '' }} >09</option>
									<option value="10" {{ ( session()->get('filter_bulan') == '10') ? 'selected' : '' }} >10</option>
									<option value="11" {{ ( session()->get('filter_bulan') == '11') ? 'selected' : '' }} >11</option>
									<option value="12" {{ ( session()->get('filter_bulan') == '12') ? 'selected' : '' }} >12</option>
								</select>
							</div>
							<div class="col-md-1" align="left"><strong style="font-size: 13px;">Tahun :</strong></div>
							<div class="col-md-2">
								<select name="TAHUN" id="TAHUN" class="form-control TAHUN" style="width: 200px">
									<option value="2023" {{ ( session()->get('filter_tahun') == '2023') ? 'selected' : '' }} >2023</option>
									<option value="2024" {{ ( session()->get('filter_tahun') == '2024') ? 'selected' : '' }} >2024</option>
								</select>
							</div>
						</div>
						
						<button class="btn btn-primary" type="submit" id="filter" class="filter" name="filter">Filter</button>
						<button class="btn btn-danger" type="button" id="resetfilter" class="resetfilter" onclick="window.location='{{url("rmutasi")}}'">Reset</button>
						<button class="btn btn-warning" type="submit" id="cetak" class="cetak" formtarget="_blank">Cetak</button>
						</form>
						<div style="margin-bottom: 15px;"></div>
						

						<!-- PASTE DIBAWAH INI -->
                    <!-- DISINI BATAS AWAL KOOLREPORT-->
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
                                    // "TINGKAT" => array(
									//     "label" => "Tingkat"
									// ),
									"GRUP" => array(
										"label" => "Grup"
									),
									"ACNO" => array(
										"label" => "Acno"
									),
									"NAMA" => array(
										"label" => "Nama"
									),
									// "JUMLAH" => array(
									//     "label" => "Jumlah",
									//     "type" => "number",
									//     "decimals" => 2,
									//     "decimalPoint" => ".",
									//     "thousandSeparator" => ",",
									//     "footer" => "sum",
									// ),
									"JUMLAH" => array(
										"label" => "Nilai",
										"type" => "number",
										"decimals" => 2,
										"decimalPoint" => ".",
										"thousandSeparator" => ",",
										"footer" => "sum",
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
                                            "targets" => 3,
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
                                                'excel',
                                                'csv',
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
					</div>
				</div>
				</form>
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
	</script>
	@endsection
