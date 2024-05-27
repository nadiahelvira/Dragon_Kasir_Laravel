	@extends('layouts.main')

	@section('content')
	<div class="content-wrapper">
		<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0">Laporan Rugi Laba Tahunan</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
				<li class="breadcrumb-item active">Laporan Rugi Laba Tahunan</li>
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
					    <form method="POST" action="{{url('jasper-rltahun-report')}}" >
					    @csrf
						<!-- Filter Tanggal -->
						<div class="form-group row">
							<div class="col-md-1" align="left"><strong style="font-size: 13px;">Tgl</strong></div>
							<div class="col-md-2">
								<input class="form-control date tglDr" id="tglDr" name="tglDr"
								type="text" autocomplete="off" value="{{ session()->get('filter_tglDari') }}"> 
							</div>
							<!-- <div class="col-md-1" align="left"><strong style="font-size: 13px;">s.d</strong></div>
							<div class="col-md-2">
								<input class="form-control date tglSmp" id="tglSmp" name="tglSmp"
								type="text" autocomplete="off" value="{{ session()->get('filter_tglSampai') }}">
							</div> -->

                            
						</div>
						<button class="btn btn-primary" type="submit" id="filter" class="filter" name="filter">Filter</button>
						<button class="btn btn-danger" type="button" id="resetfilter" class="resetfilter" onclick="window.location='{{url("rrltahun")}}'">Reset</button>
						<button class="btn btn-warning" type="submit" id="cetak" class="cetak" formtarget="_blank">Cetak</button>
						</form>
						

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
                                    // "GOL" => array(
                                    // 	"label" => "Gol"
                                    // ),
                                    // "KODE" => array(
                                    // 	"label" => "Kode"
                                    // ),
                                    "NAMA" => array(
                                        "label" => "Nama"
                                    ),
                                    "01" => array(
                                        "label" => "01",
                                        "type" => "number",
                                        "decimals" => 2,
                                        "decimalPoint" => ".",
                                        "thousandSeparator" => ",",
                                        "footer" => "sum",
                                    ),
                                    "JUM01" => array(
                                        "label" => "+ / -",
                                        "type" => "number",
                                        "decimals" => 2,
                                        "decimalPoint" => ".",
                                        "thousandSeparator" => ",",
                                        "footer" => "sum",
                                    ),
                                    "02" => array(
                                        "label" => "02",
                                        "type" => "number",
                                        "decimals" => 2,
                                        "decimalPoint" => ".",
                                        "thousandSeparator" => ",",
                                        "footer" => "sum",
                                    ),
                                    "JUM02" => array(
                                        "label" => "+ / -",
                                        "type" => "number",
                                        "decimals" => 2,
                                        "decimalPoint" => ".",
                                        "thousandSeparator" => ",",
                                        "footer" => "sum",
                                    ),
                                    "03" => array(
                                        "label" => "03",
                                        "type" => "number",
                                        "decimals" => 2,
                                        "decimalPoint" => ".",
                                        "thousandSeparator" => ",",
                                        "footer" => "sum",
                                    ),
                                    "JUM03" => array(
                                        "label" => "+ / -",
                                        "type" => "number",
                                        "decimals" => 2,
                                        "decimalPoint" => ".",
                                        "thousandSeparator" => ",",
                                        "footer" => "sum",
                                    ),
                                    "04" => array(
                                        "label" => "04",
                                        "type" => "number",
                                        "decimals" => 2,
                                        "decimalPoint" => ".",
                                        "thousandSeparator" => ",",
                                        "footer" => "sum",
                                    ),
                                    "JUM04" => array(
                                        "label" => "+ / -",
                                        "type" => "number",
                                        "decimals" => 2,
                                        "decimalPoint" => ".",
                                        "thousandSeparator" => ",",
                                        "footer" => "sum",
                                    ),
                                    "05" => array(
                                        "label" => "05",
                                        "type" => "number",
                                        "decimals" => 2,
                                        "decimalPoint" => ".",
                                        "thousandSeparator" => ",",
                                        "footer" => "sum",
                                    ),
                                    "JUM05" => array(
                                        "label" => "+ / -",
                                        "type" => "number",
                                        "decimals" => 2,
                                        "decimalPoint" => ".",
                                        "thousandSeparator" => ",",
                                        "footer" => "sum",
                                    ),
                                    "06" => array(
                                        "label" => "06",
                                        "type" => "number",
                                        "decimals" => 2,
                                        "decimalPoint" => ".",
                                        "thousandSeparator" => ",",
                                        "footer" => "sum",
                                    ),
                                    "JUM06" => array(
                                        "label" => "+ / -",
                                        "type" => "number",
                                        "decimals" => 2,
                                        "decimalPoint" => ".",
                                        "thousandSeparator" => ",",
                                        "footer" => "sum",
                                    ),
                                    "07" => array(
                                        "label" => "07",
                                        "type" => "number",
                                        "decimals" => 2,
                                        "decimalPoint" => ".",
                                        "thousandSeparator" => ",",
                                        "footer" => "sum",
                                    ),
                                    "JUM07" => array(
                                        "label" => "+ / -",
                                        "type" => "number",
                                        "decimals" => 2,
                                        "decimalPoint" => ".",
                                        "thousandSeparator" => ",",
                                        "footer" => "sum",
                                    ),
                                    "08" => array(
                                        "label" => "08",
                                        "type" => "number",
                                        "decimals" => 2,
                                        "decimalPoint" => ".",
                                        "thousandSeparator" => ",",
                                        "footer" => "sum",
                                    ),
                                    "JUM08" => array(
                                        "label" => "+ / -",
                                        "type" => "number",
                                        "decimals" => 2,
                                        "decimalPoint" => ".",
                                        "thousandSeparator" => ",",
                                        "footer" => "sum",
                                    ),
                                    "09" => array(
                                        "label" => "09",
                                        "type" => "number",
                                        "decimals" => 2,
                                        "decimalPoint" => ".",
                                        "thousandSeparator" => ",",
                                        "footer" => "sum",
                                    ),
                                    "JUM09" => array(
                                        "label" => "+ / -",
                                        "type" => "number",
                                        "decimals" => 2,
                                        "decimalPoint" => ".",
                                        "thousandSeparator" => ",",
                                        "footer" => "sum",
                                    ),
                                    "10" => array(
                                        "label" => "10",
                                        "type" => "number",
                                        "decimals" => 2,
                                        "decimalPoint" => ".",
                                        "thousandSeparator" => ",",
                                        "footer" => "sum",
                                    ),
                                    "JUM10" => array(
                                        "label" => "+ / -",
                                        "type" => "number",
                                        "decimals" => 2,
                                        "decimalPoint" => ".",
                                        "thousandSeparator" => ",",
                                        "footer" => "sum",
                                    ),
                                    "11" => array(
                                        "label" => "11",
                                        "type" => "number",
                                        "decimals" => 2,
                                        "decimalPoint" => ".",
                                        "thousandSeparator" => ",",
                                        "footer" => "sum",
                                    ),
                                    "JUM11" => array(
                                        "label" => "+ / -",
                                        "type" => "number",
                                        "decimals" => 2,
                                        "decimalPoint" => ".",
                                        "thousandSeparator" => ",",
                                        "footer" => "sum",
                                    ),
                                    "02" => array(
                                        "label" => "02",
                                        "type" => "number",
                                        "decimals" => 2,
                                        "decimalPoint" => ".",
                                        "thousandSeparator" => ",",
                                        "footer" => "sum",
                                    ),
                                    "JUM02" => array(
                                        "label" => "+ / -",
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
                                            "targets" => [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22],
                                        ),
                                    ),
                                    "order" => [],
                                    "paging" => true,
                                    // "pageLength" => 12,
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
			// fill_datatable();
// GANTI 3.1 SESUAI GANTI 2.1
		//	function fill_datatable( acno = '')
// 		function fill_datatable(per='')	
// 		{
// 				var dataTable = $('.datatable').DataTable({
// 					dom: '<"row"<"col-4"B>>ltip',
// 					processing: true,
// 					serverSide: true,
// 					autoWidth: true,
// 					'scrollY': '400px',
// 					"order": [[ 0, "asc" ]],
// 					ajax: 
// 					{
// // GANTI 4 SESUAI resources -routes - web - GANTI 1
// 						url: "{{ route('get-rl-report') }}",
// 						data: {
// 							perio: per,
// 						},
// 					},
// 					columns: 
// 					[
// // GANTI 5 SESUAI DENGAN GANTI 3
// 						{data: 'DT_RowIndex', orderable: false, searchable: false },
// 						{data: 'KODE', name: 'KODE'},
// 						{data: 'NAMA', name: 'NAMA'},
//                         {
// 					      data: 'JUM', 
// 					      name: 'JUM',
// 					      render: $.fn.dataTable.render.number( ',', '.', 2, '' )
// 				        },
// 						{
// 					      data: 'AK', 
// 					      name: 'AK',
// 					      render: $.fn.dataTable.render.number( ',', '.', 2, '' )
// 				        }
// 					]
					
					
// 				});
// 			}
			
// 			$('#filter').click(function() {
// // GANTI 5.1 SESUAI GANTI 2.1
// 				//var acno = $('#acno').val();
// 				//if (acno != '')
// 				//{
// 					$('.datatable').DataTable().destroy();
// 					var periode = $('#perio').val();
// 					fill_datatable(periode);
// 				//}
// 			});
// 			$('#resetfilter').click(function() {
// 				var periode = '';

// 				$('.datatable').DataTable().destroy();
// 				fill_datatable(periode);
// // BATAS GANTI 5.1
// 			});
		});
	</script>
	@endsection
