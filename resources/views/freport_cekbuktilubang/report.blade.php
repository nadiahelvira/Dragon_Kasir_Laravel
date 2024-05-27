	@extends('layouts.main')

	@section('content')
	<div class="content-wrapper">
		<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0">Laporan Cek Bukti Lubang</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
				<li class="breadcrumb-item active">Laporan Cek Bukti Lubang/li>
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
						<form method="POST" action="{{url('rcekbuktilubang/jasper-cekbuktilubang-report')}}">
						@csrf
						
						<div class="form-group row">
							<div class="col-md-1">
								<label for="TYPE" class="form-label">Jenis</label>
							</div>
							<div class="col-md-2">
								<select name="TYPE" id="TYPE" class="form-control TYPE" style="width: 200px">
									<option value="-">Semua</option>
									<option value="BKM" {{ ( session()->get('filter_type') == 'BKM') ? 'selected' : '' }} >BKM</option>
									<option value="BKK" {{ ( session()->get('filter_type') == 'BKK') ? 'selected' : '' }} >BKK</option>
									<option value="BBM" {{ ( session()->get('filter_type') == 'BBM') ? 'selected' : '' }} >BBM</option>
									<option value="BBK" {{ ( session()->get('filter_type') == 'BBK') ? 'selected' : '' }} >BBK</option>
								</select>
							</div>
                        </div>
						 
						<button class="btn btn-primary" type="submit" id="filter" class="filter" name="filter">Filter</button>
						<button class="btn btn-danger" type="button" id="resetfilter" class="resetfilter" onclick="window.location='{{url("kasbankpertanggal")}}'">Reset</button>
						<button class="btn btn-warning" type="submit" id="cetak" class="cetak" formtarget="_blank">Cetak</button>
						</form>
						<div style="margin-bottom: 15px;"></div>
						<!--
						<table class="table table-fixed table-striped table-border table-hover nowrap datatable">
							<thead class="table-dark">
								<tr>
									<th scope="col" style="text-align: center">#</th>
									<th scope="col" style="text-align: center">Bukti</th>
									<th scope="col" style="text-align: center">Tgl</th>
									<th scope="col" style="text-align: center">Bank#</th>
									<th scope="col" style="text-align: center">-</th>
									<th scope="col" style="text-align: center">Acno#</th>
									<th scope="col" style="text-align: center">-</th>
									<th scope="col" style="text-align: center">Uraian</th>
									<th scope="col" style="text-align: center">Debet</th>
									<th scope="col" style="text-align: center">Kredit</th>
									<th scope="col" style="text-align: center">Saldo</th>

								</tr>
							</thead>
							<tbody>
							</tbody> 
							<tfoot>
								<tr>
									<th></th>
									<th>Total</th>
									<th></th>
									<th></th>
									<th></th>
									<th></th>
									<th></th>
									<th></th>
									<th></th>
									<th></th>
									<th></th>
								</tr>
							</tfoot>
						</table> -->
						
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
                                    "NO_BUKTI" => array(
                                        "label" => "Bukti#",
                                    ),
                                    "TYPE" => array(
                                        "label" => "Jenis",
                                    ),
                                    "URAIAN" => array(
                                        "label" => "Uraian",
                                        "footerText" => "<b>Grand Total :</b>",
                                    ),
                                    "ACNO" => array(
                                        "label" => "Perk",
                                    ),
                                    "TGL" => array(
                                        "label" => "Tanggal",
                                    ),
                                    // "BACNO" => array(
                                    //     "label" => "Bank#",
                                    // ),
                                    // "BNAMA" => array(
                                    //     "label" => "-",
                                    // ),
                                    // "NACNO" => array(
                                    //     "label" => "-",
                                    // ),
                                    "KASDEBET" => array(
                                        "label" => "Kas Debet",
                                        "type" => "number",
                                        "decimals" => 2,
                                        "decimalPoint" => ".",
                                        "thousandSeparator" => ",",
                                        "footer" => "sum",
                                        "footerText" => "<b>@value</b>",
                                    ),
                                    "KASKREDIT" => array(
                                        "label" => "Kas Kredit",
                                        "type" => "number",
                                        "decimals" => 2,
                                        "decimalPoint" => ".",
                                        "thousandSeparator" => ",",
                                        "footer" => "sum",
                                        "footerText" => "<b>@value</b>",
                                    ),
                                    "BANKDEBET" => array(
                                        "label" => "Bank Debet",
                                        "type" => "number",
                                        "decimals" => 2,
                                        "decimalPoint" => ".",
                                        "thousandSeparator" => ",",
                                        "footer" => "sum",
                                        "footerText" => "<b>@value</b>",
                                    ),
                                    "BANKKREDIT" => array(
                                        "label" => "Bank Kredit",
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
                                            "targets" => [7,8,9],
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

		});
	</script>
	@endsection
