	@extends('layouts.main')

	@section('content')
	<div class="content-wrapper">
		<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0">Oper BBK BBM</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
				<li class="breadcrumb-item active">Oper BBK BBM</li>
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
						<form method="POST" action="{{url('roperbbmbbk/jasper-operbbmbbk-report')}}" name ="entri" id="entri" >
						@csrf

						<!-- Filter No Bukti -->
						<div class="form-group row">
							<div class="col-md-1" align="left"><strong style="font-size: 13px;">No Bukti Awal</strong></div>
							<div class="col-md-2">
								<input type="text" class="form-control nobukti1" id="nobukti1" name="nobukti1" placeholder="" onblur="isi_sampai()" value="{{ session()->get('filter_nobukti1') }}" >
								
								<input type="text" class="form-control pilihan" id="pilihan" name='pilihan' placeholder='' value='0' hidden>
								
							</div>

							<div class="col-md-2" align="right"><strong style="font-size: 13px;">No Bukti Akhir</strong></div>
							<div class="col-md-2">
								<input type="text" class="form-control nobukti2" id="nobukti2" name="nobukti2" placeholder="ZZZ" value="{{ session()->get('filter_nobukti2') }}">
							</div>
						</div>
						
						<div class="form-group row">
							<div class="col-md-1">
								<label for="TYPE" class="form-label">Jenis Bank</label>
							</div>
							<div class="col-md-2">
								<select name="TYPE" id="TYPE" class="form-control TYPE" style="width: 200px">
									<option value="BBM" {{ ( session()->get('filter_type') == 'BBM') ? 'selected' : '' }} >BBM</option>
									<option value="BBK" {{ ( session()->get('filter_type') == 'BBK') ? 'selected' : '' }} >BBK</option>
								</select>
							</div>
							
							<div class="col-md-2" align="right"><strong style="font-size: 13px;">No Bukti Baru</strong></div>
							<div class="col-md-2">
								<input type="text" class="form-control nobaru" id="nobaru" name="nobaru" placeholder="" value="{{ session()->get('filter_nobaru') }}">
							</div>
						</div>
						
						
						 
						<button class="btn btn-primary" type="submit" id="filter" class="filter" name="filter">CARI</button>
						<button class="btn btn-danger" type="button" id="resetfilter" class="resetfilter" onclick="window.location='{{url("roperbbmbbk")}}'">RESET</button>
						<!-- <button class="btn btn-warning" type="submit" id="cetak" class="cetak" formtarget="_blank">Cetak</button> -->
						<button class="btn btn-primary" onclick="gantix()"   id="ganti" class="ganti" name="ganti">GANTI</button>	
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
                                    "NO_BUKTI" => array(
                                        "label" => "Bukti#",
                                    ),
                                    "TGL" => array(
                                        "label" => "Tanggal",
                                    ),
                                    "KET" => array(
                                        "label" => "Ket",
                                    ),
                                    "JUMLAH" => array(
                                        "label" => "Jumlah",
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
                                            "targets" => 3,
                                            // "targets" => [],
                                        ),
                                    ),
                                    "order" => [],
                                    "paging" => true,
                                    // "pageLength" => 12,
									"LengthMenu" => [[10, 25, 50,-1], [10,25,50, "All"]],
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
		
		function isi_sampai()
		{
			
			var DARIX = $('#nobukti1').val();
			var SAMPAIX = $('#nobukti2').val();
			
			if ( SAMPAIX =='ZZZ' )
			{
    
	            $('#nobukti2').val(DARIX);
				
            }	
			
		   
		}


		function gantix()
		{
		   
		   $('#pilihan').val(1);
			
           document.getElementById("entri").submit()
			
		   
		}

		
	</script>
	@endsection
