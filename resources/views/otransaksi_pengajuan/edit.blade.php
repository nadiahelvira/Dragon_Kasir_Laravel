@extends('layouts.main')


<style>
    .card {

    }

    .form-control:focus {
        background-color: #E0FFFF !important;
    }

	.block {
	display: block;
	width: 70%;
	border: none;
	background-color: #04AA6D;
	color: rgb(51, 161, 29);
	padding: 14px 28px;
	font-size: 16px;
	cursor: pointer;
	text-align: center;
	}
	
	
	
	.table-scrollable {
		margin: 0;
		padding: 0;
	}

	table {
		table-layout: fixed !important;
	}



	.fixTableHead { 
    	overflow-y: auto; 
    	height: 110px; 
    } 
    .fixTableHead thead { 
    	position: sticky; 
    	top: 0; 
    } 
	.fixTableHead tfoot tr td { 
    	position: sticky; 
    	bottom: 0; 
    } 
	table { 
    	border-collapse: collapse;         
    	width: 100%; 
    }
    th { 
    	background: #346ed8; 
    }
</style>

@section('content')

<? $judul=$_GET['judul'] ?>
<? $flagz=$_GET['flagz'] ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
			<div class="col-sm-6">
               <h1 class="m-0">Edit Transaksi {{$header->NO_BUKTI}}</h1>	
            </div>
            <!-- /.col -->
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
                    <!-- <form action="{{url('/pengajuan/update/'.$header->ROW_ID)}}" id="entri" method="POST"> -->
					
						<form action="{{($tipx=='new')? url('/pengajuan/store?flagz='.$flagz.'') : url('/pengajuan/update/'.$header->ROW_ID.'&flagz='.$flagz.'' ) }}" method="POST" name ="entri" id="entri" >
  
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
                                    <label for="NO_BUKTI" class="form-label">Bukti#</label>
                                </div>
				
                                <input type="text" class="form-control ROW_ID" id="ROW_ID" name="ROW_ID"
                                    placeholder="Masukkan ROW_ID" value="{{$header->ROW_ID ?? ''}}" hidden readonly>
																		
                                <div class="col-md-4">

									<input name="tipx" class="form-control tipx" id="tipx" value="{{$tipx}}" hidden >
									<input name="flagz" class="form-control flagz" id="flagz" value="{{$flagz}}" hidden >

                                    <input type="text" class="form-control NO_BUKTI" id="NO_BUKTI" name="NO_BUKTI"
                                    placeholder="Masukkan Bukti#" value="{{$header->NO_BUKTI ?? ''}}" >
								</div>

								<div class="col-md-2"></div>
					
								<div class="col-md-3 input-group">

									<input type="text" class="form-control CARI" id="CARI" name="CARI"
                                    placeholder="Cari Bukti#" value="" >
									<button type="button" id='SEARCHX'  onclick="CariBukti()" class="btn btn-outline-primary"><i class="fas fa-search"></i></button>

								</div> 
							</div>
							
        
							<div class="form-group row">
                                <div class="col-md-2">
                                    <label for="TGL" class="form-label">Tgl</label>
                                </div>
								<div class="col-md-2">
								  <input class="form-control date" id="TGL" name="TGL" data-date-format="dd-mm-yyyy" type="text" autocomplete="off" value="{{date('d-m-Y',strtotime($header->TGL))}}">
								</div>	
                            </div>
						
						
						
							<div class="form-group row">
								<div class="col-md-1">
                                </div>
								<div class="col-md-2">
									<?php
										if ($header->ttd_ceo == 0)
												echo '<a 
												type="button" 
												class="btn btn-warning btn-center block"
												onclick=""
												href="#"
											>
											<span style="color: black; font-weight: bold;"><i class="fa fa-upload"></i> DIREKTUR</span>
										</a>';
											else echo '<a 
											type="label"
											class="btn btn-success btn-center block" 
												>
											<span style="color: black; font-weight: bold;"><i class="fa fa-check"></i> DIREKTUR</span>
										</a>';
									?>
								</div>
								<div class="col-md-2">
									<?php
										if ($header->ttd_hrd == 0)
												echo '<a 
												type="button" 
												class="btn btn-secondary btn-center block"
												onclick=""
												href="#"
											>
											<span style="color: black; font-weight: bold;"><i class="fa fa-upload"></i> PAYROLL</span>
										</a>';
											else echo '<a 
											type="label"
											class="btn btn-success btn-center block" 
												>
											<span style="color: black; font-weight: bold;"><i class="fa fa-check"></i> PAYROLL</span>
										</a>';
									?>
								</div>
								<div class="col-md-2">
									<?php
										if ($header->ttd_fm == 0)
												echo '<a 
												type="button" 
												class="btn btn-secondary btn-center block"
												onclick=""
												href="#"
											>
											<span style="color: black; font-weight: bold;"><i class="fa fa-upload"></i> FM</span>
										</a>';
											else echo '<a 
											type="label"
											class="btn btn-success btn-center block" 
												>
											<span style="color: black; font-weight: bold;"><i class="fa fa-check"></i> FM</span>
										</a>';
									?>
								</div>
								<div class="col-md-2">
									<?php
										if ($header->ttd_pr == 0)
												echo '<a 
												type="button" 
												class="btn btn-secondary btn-center block"
												onclick=""
												href="#"
											>
											<span style="color: black; font-weight: bold;"><i class="fa fa-upload"></i> PRODUKSI</span>
										</a>';
											else echo '<a 
											type="label"
											class="btn btn-success btn-center block" 
												>
											<span style="color: black; font-weight: bold;"><i class="fa fa-check"></i> PRODUKSI</span>
										</a>';
									?>
								</div>
								<div class="col-md-2">
									<?php
										if ($header->ttd_ie == 0)
												echo '<a 
												type="button" 
												class="btn btn-secondary btn-center block"
												onclick="btVerifikasi5()"
												href="#"
											>
											<span style="color: black; font-weight: bold;"><i class="fa fa-upload"></i> IE</span>
										</a>';
											else echo '<a 
											type="label"
											class="btn btn-success btn-center block" 
												>
											<span style="color: black; font-weight: bold;"><i class="fa fa-check"></i> IE</span>
										</a>';
									?>
								</div>
							</div>
							
						
                     
							<hr style="margin-top: 30px; margin-buttom: 30px">
							
							<!-- scroll samping&bawah -->
							
							<!-- <div style="overflow-y:scroll; height:200px;" class="col-md-12 scrollable" align="right"> -->
							<div style="overflow-y:scroll; height:500px;" class="col-md-12 scrollable fixTableHead fixTableFoot" align="right">
							
								<!-- <table id="datatable" class="table table-striped table-border table-scrollable"> -->
								<table id="datatable" class="table table-striped table-border table-scrollable">
								
							<!-- batas scroll --> 
							
									<thead>
										<tr>
											<th width="50px">No.</th>
											<th width="500px">
												<label style="color:red;font-size:20px">* </label>
												<label for="ARTICLE" class="form-label">NAMA ARTICLE</label>
											</th>
											<th {{( $flagz =='1IJ' || $flagz =='2CV' || $flagz =='2IJ' || $flagz =='3IJ') ? '' : 'hidden' }} width="250px">CUTTING</th>
											<th {{( $flagz =='1IJ' || $flagz =='2CV' || $flagz =='2IJ' || $flagz =='3IJ' || $flagz =='2AB') ? '' : 'hidden' }} width="250px">PRINT EMBOSSS</th>
											<th {{( $flagz =='1IJ' || $flagz =='2CV' || $flagz =='2IJ' || $flagz =='3IJ' || $flagz =='2AB') ? '' : 'hidden' }} width="250px">PSP</th>
											<th {{( $flagz =='1IJ' || $flagz =='2IJ' || $flagz =='3IJ') ? '' : 'hidden' }} width="250px">JUKI</th>
											<th {{( $flagz =='1IJ' || $flagz =='2IJ' || $flagz =='3IJ') ? '' : 'hidden' }} width="250px">SEWING</th>
											<th {{( $flagz =='1IJ' || $flagz =='2IJ' || $flagz =='3IJ') ? '' : 'hidden' }} width="250px">INJECT/INSERT</th>
											<th {{( $flagz =='1IJ' || $flagz =='2IJ' || $flagz =='3IJ' || $flagz =='2CV' || $flagz =='2CM') ? '' : 'hidden' }} width="250px">PACKING</th>
											<th {{( $flagz =='2CV') ? '' : 'hidden' }} width="250px">PSP ASSEMB</th>
											<th {{( $flagz =='2CV' || $flagz =='2CM') ? '' : 'hidden' }} width="250px">ASSEMBLING</th>
											<th {{( $flagz =='2CM') ? '' : 'hidden' }} width="250px">STOCKFIT</th>
											<th {{( $flagz =='2AB') ? '' : 'hidden' }} width="250px">INJECT/C.SOL</th>
											<th {{( $flagz =='2AB') ? '' : 'hidden' }} width="250px">PSP CAT SPRAY</th>
											<th {{( $flagz =='2AB') ? '' : 'hidden' }} width="250px">CAT SPRAY/KUAS</th>
											<th {{( $flagz =='2AB') ? '' : 'hidden' }} width="250px">PSP FLOCKING</th>
											<th {{( $flagz =='2AB') ? '' : 'hidden' }} width="250px">FLOCKING</th>
											<th {{( $flagz =='2AB' || $flagz =='2PY') ? '' : 'hidden' }} width="250px">ASS.PACKING</th>
											<th {{( $flagz =='2AB') ? '' : 'hidden' }} width="250px">COMPOUND</th>
											<th {{( $flagz =='2AB') ? '' : 'hidden' }} width="250px">GLG. AVALAN</th>
											<th {{( $flagz =='2PY') ? '' : 'hidden' }} width="250px">INJECT</th>
											<th {{( $flagz =='2PY') ? '' : 'hidden' }} width="250px">PLONG</th>
											<th {{( $flagz =='2PY') ? '' : 'hidden' }} width="250px">SABLON</th>
											<th {{( $flagz =='2PY') ? '' : 'hidden' }} width="250px">JAHIT</th>
											<th {{( $flagz =='2PY') ? '' : 'hidden' }} width="250px">CAT SPRAY</th>
											<th {{( $flagz =='2PY') ? '' : 'hidden' }} width="250px">MICRO</th>
									<!--	<th {{( $flagz =='4IJ') ? '' : 'hidden' }}width="250px">BORDIR</th>
											<th {{( $flagz =='4IJ') ? '' : 'hidden' }}width="250px">SABLON PRESS</th>
											<th {{( $flagz =='4IJ') ? '' : 'hidden' }}width="250px">PERS.JAHIT</th>
											<th {{( $flagz =='4IJ') ? '' : 'hidden' }}width="250px">PERS.ASS</th>
									-->
											<th></th>
										</tr>
									</thead>
									<tbody>
									<?php $no=0 ?>
									@foreach ($detail as $detail)
										<tr>
											<td>
												<input type="hidden" name="ROW_ID[]" id="ROW_ID{{$no}}" type="text" value="{{$detail->ROW_ID}}" 
												class="form-control ROW_ID" onkeypress="return tabE(this,event)" readonly>
												
												<input name="REC[]" id="REC{{$no}}" type="text" value="{{$detail->REC}}" 
												class="form-control REC" onkeypress="return tabE(this,event)" readonly>
											</td>
											<td>
												<input name="ARTICLE[]" id="ARTICLE{{$no}}" type="text" value="{{$detail->ARTICLE}}"
													class="form-control ARTICLE " required>
											</td>
											<td {{( $flagz =='1IJ' || $flagz =='2CV' || $flagz =='2IJ' || $flagz =='3IJ' || $flagz =='2PY') ? '' : 'hidden' }}>
												<input name="CUTTING[]" onclick="select()" onkeyup="hitung()"
													id="CUTTING{{$no}}" type="text" value="{{$detail->CUTTING}}"
													style="text-align: right"
													class="form-control CUTTING text-primary">
											</td>
											<td {{( $flagz =='1IJ' || $flagz =='2CV' || $flagz =='2IJ' || $flagz =='3IJ' || $flagz =='2AB' || $flagz =='2PY') ? '' : 'hidden' }}>
												<input name="EMBOS[]" onclick="select()" onkeyup="hitung()"
													id="EMBOS{{$no}}" type="text" value="{{$detail->EMBOS}}"
													style="text-align: right " 
													class="form-control EMBOSS text-primary">
											</td>
											<td {{( $flagz =='1IJ' || $flagz =='2CV' || $flagz =='2IJ' || $flagz =='3IJ' || $flagz =='2AB') ? '' : 'hidden' }}>
												<input name="PSP[]" onclick="select()" onkeyup="hitung()"
													id="PSP{{$no}}" type="text" value="{{$detail->PSP}}"
													style="text-align: right " 
													class="form-control PSP text-primary">
											</td>
											<td {{( $flagz =='1IJ' || $flagz =='2IJ' || $flagz =='3IJ') ? '' : 'hidden' }}>
												<input name="JUKI[]" onclick="select()" onkeyup="hitung()"
													id="JUKI{{$no}}" type="text" value="{{$detail->JUKI}}"
													style="text-align: right " 
													class="form-control JUKI text-primary">
											</td>
											<td {{( $flagz =='1IJ' || $flagz =='2IJ' || $flagz =='3IJ' || $flagz =='2PY') ? '' : 'hidden' }}>
												<input name="JAHIT[]" onclick="select()" onkeyup="hitung()"
													id="JAHIT{{$no}}" type="text" value="{{$detail->JAHIT}}"
													style="text-align: right " 
													class="form-control JAHIT text-primary">
											</td>
											<td {{( $flagz =='1IJ' || $flagz =='2IJ' || $flagz =='3IJ' || $flagz =='2AB' || $flagz =='2PY') ? '' : 'hidden' }}>
												<input name="INJECT[]" onclick="select()" onkeyup="hitung()"
													id="INJECT{{$no}}" type="text" value="{{$detail->INJECT}}"
													style="text-align: right " 
													class="form-control INJECT text-primary">
											</td>
											<td {{( $flagz =='1IJ' || $flagz =='2IJ' || $flagz =='3IJ' || $flagz =='2CV' || $flagz =='2CM') ? '' : 'hidden' }}>
												<input name="PACKING[]" onclick="select()" onkeyup="hitung()"
													id="PACKING{{$no}}" type="text" value="{{$detail->PACKING}}"
													style="text-align: right " 
													class="form-control PACKING text-primary">
											</td>
											<td {{( $flagz =='2CV') ? '' : 'hidden' }}>
												<input name="PSP_ASSB[]" onclick="select()" onkeyup="hitung()"
													id="PSP_ASSB{{$no}}" type="text" value="{{$detail->PSP_ASSB}}"
													style="text-align: right " 
													class="form-control PSP_ASSB text-primary">
											</td>
											<td {{( $flagz =='2CV' || $flagz =='2CM' ) ? '' : 'hidden' }}>
												<input name="ASSEMBLING[]" onclick="select()" onkeyup="hitung()"
													id="ASSEMBLING{{$no}}" type="text" value="{{$detail->ASSEMBLING}}"
													style="text-align: right " 
													class="form-control ASSEMBLING text-primary">
											</td>
											<td {{( $flagz =='2CM' ) ? '' : 'hidden' }}>
												<input name="STOCKFIT[]" onclick="select()" onkeyup="hitung()"
													id="STOCKFIT{{$no}}" type="text" value="{{$detail->STOCKFIT}}"
													style="text-align: right " 
													class="form-control STOCKFIT text-primary">
											</td>
											<td {{( $flagz =='2AB') ? '' : 'hidden' }}>
												<input name="PSP_CAT[]" onclick="select()" onkeyup="hitung()"
													id="PSP_CAT{{$no}}" type="text" value="{{$detail->PSP_CAT}}"
													style="text-align: right " 
													class="form-control PSP_CAT text-primary">
											</td>
											<td {{( $flagz =='2AB' || $flagz =='2PY' ) ? '' : 'hidden' }}>
												<input name="CAT_SPRAY[]" onclick="select()" onkeyup="hitung()"
													id="CAT_SPRAY{{$no}}" type="text" value="{{$detail->CAT_SPRAY}}"
													style="text-align: right " 
													class="form-control CAT_SPRAY text-primary">
											</td>
											<td {{( $flagz =='2AB') ? '' : 'hidden' }}>
												<input name="PSP_FLOCK[]" onclick="select()" onkeyup="hitung()"
													id="PSP_FLOCK{{$no}}" type="text" value="{{$detail->PSP_FLOCK}}"
													style="text-align: right " 
													class="form-control PSP_FLOCK text-primary">
											</td>
											<td {{( $flagz =='2AB') ? '' : 'hidden' }}>
												<input name="FLOCKING[]" onclick="select()" onkeyup="hitung()"
													id="FLOCKING{{$no}}" type="text" value="{{$detail->FLOCKING}}"
													style="text-align: right " 
													class="form-control FLOCKING text-primary">
											</td>
											<td {{( $flagz =='2AB' || $flagz =='2PY') ? '' : 'hidden' }}>
												<input name="ASSB_PACKING[]" onclick="select()" onkeyup="hitung()"
													id="ASSB_PACKING{{$no}}" type="text" value="{{$detail->ASSB_PACKING}}"
													style="text-align: right " 
													class="form-control ASSB_PACKING text-primary">
											</td>
											<td {{( $flagz =='2AB') ? '' : 'hidden' }}>
												<input name="COMP[]" onclick="select()" onkeyup="hitung()"
													id="COMP{{$no}}" type="text" value="{{$detail->COMP}}"
													style="text-align: right " 
													class="form-control COMP text-primary">
											</td>
											<td {{( $flagz =='2AB') ? '' : 'hidden' }}>
												<input name="GILING[]" onclick="select()" onkeyup="hitung()"
													id="GILING{{$no}}" type="text" value="{{$detail->GILING}}"
													style="text-align: right " 
													class="form-control GILING text-primary">
											</td>
											<td {{( $flagz =='2PY') ? '' : 'hidden' }}>
												<input name="MICRO[]" onclick="select()" onkeyup="hitung()"
													id="MICRO{{$no}}" type="text" value="{{$detail->MICRO}}"
													style="text-align: right " 
													class="form-control MICRO text-primary">
											</td>
									<!--		<td {{( $flagz =='4IJ') ? '' : 'hidden' }}>
												<input name="BORDIR[]" onclick="select()" onkeyup="hitung()"
													id="BORDIR{{$no}}" type="text" value="{{$detail->BORDIR}}"
													style="text-align: right " 
													class="form-control BORDIR text-primary">
											</td>
									-->		
											<td>
												<button type="button" class="btn btn-sm btn-circle btn-outline-danger btn-delete" id='DELETEX{{$no}}' onclick="">
													<i class="fa fa-fw fa-trash"></i>
												</button>
											</td>
											
										</tr>
									<?php $no++; ?>	
									@endforeach
										
										
									</tbody>
									<tfoot>
										 <tr>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											</tr>
									</tfoot>
								</table> 
								
						<!-- nambah div ini -->						
							</div>
						<!-- batas div -->
						
							<div class="col-md-2 row"></div>
                            <div class="col-md-2 row">
                                <button type="button" id='PLUSX' onclick="tambah()" class="btn btn-sm btn-success"><i class="fas fa-plus fa-sm md-3"></i> </button>
                            </div>			
                            
							<div class="form-group row">
							</div>
							
							<div class="form-group row">
								<div class="col-md-1">
									<label class="form-label">Keterangan</label>
								</div>
								<div class="col-md-5">
									<input type="text" class="form-control ket1" id="ket1" name="ket1" placeholder="" value="{{$header->ket1}}">
								</div>
								<div class="col-md-5">
									<input type="text" class="form-control ket6" id="ket6" name="ket6" placeholder="" value="{{$header->ket6}}">
								</div>
							</div>
							
							<div class="form-group row">
								<div class="col-md-1">
									<label class="form-label"></label>
								</div>
								<div class="col-md-5">
									<input type="text" class="form-control ket2" id="ket2" name="ket2" placeholder="" value="{{$header->ket2}}">
								</div>
								<div class="col-md-5">
									<input type="text" class="form-control ket7" id="ket7" name="ket7" placeholder="" value="{{$header->ket7}}">
								</div>
							</div>
							
							<div class="form-group row">
								<div class="col-md-1">
									<label class="form-label"></label>
								</div>
								<div class="col-md-5">
									<input type="text" class="form-control ket3" id="ket3" name="ket3" placeholder="" value="{{$header->ket3}}">
								</div>
								<div class="col-md-5">
									<input type="text" class="form-control ket8" id="ket8" name="ket8" placeholder="" value="{{$header->ket8}}">
								</div>
							</div>
							
							<div class="form-group row">
								<div class="col-md-1">
									<label class="form-label"></label>
								</div>
								<div class="col-md-5">
									<input type="text" class="form-control ket4" id="ket4" name="ket4" placeholder="" value="{{$header->ket4}}">
								</div>
								<div class="col-md-5">
									<input type="text" class="form-control ket9" id="ket9" name="ket9" placeholder="" value="{{$header->ket9}}">
								</div>
							</div>
							
							<div class="form-group row">
								<div class="col-md-1">
									<label class="form-label"></label>
								</div>
								<div class="col-md-5">
									<input type="text" class="form-control ket5" id="ket5" name="ket5" placeholder="" value="{{$header->ket5}}">
								</div>
								<div class="col-md-5">
									<input type="text" class="form-control ket10" id="ket10" name="ket10" placeholder="" value="{{$header->ket10}}">
								</div>
							</div>
                        </div>
						
						<!--- TOMBOL NEXT, PREV, DLL -->
        
                        <div class="mt-3 col-md-12 form-group row">
							<div class="col-md-4">
								<button type="button" id='TOPX'  onclick="location.href='{{url('/pengajuan/edit/?idx=' .$idx. '&tipx=top&flagz='.$flagz.'' )}}'" class="btn btn-outline-primary">Top</button>
								<button type="button" id='PREVX' onclick="location.href='{{url('/pengajuan/edit/?idx='.$header->ROW_ID.'&tipx=prev&flagz='.$flagz.'&buktix='.$header->NO_BUKTI )}}'" class="btn btn-outline-primary">Prev</button>
								<button type="button" id='NEXTX' onclick="location.href='{{url('/pengajuan/edit/?idx='.$header->ROW_ID.'&tipx=next&flagz='.$flagz.'&buktix='.$header->NO_BUKTI )}}'" class="btn btn-outline-primary">Next</button>
								<button type="button" id='BOTTOMX' onclick="location.href='{{url('/pengajuan/edit/?idx=' .$idx. '&tipx=bottom&flagz='.$flagz.'' )}}'" class="btn btn-outline-primary">Bottom</button>
							</div>
							
							<div class="col-md-5">
								<button type="button" id='NEWX' onclick="location.href='{{url('/pengajuan/edit/?idx=0&tipx=new&flagz='.$flagz.'' )}}'" class="btn btn-warning">New</button>
								<button type="button" id='EDITX' onclick='hidup()' class="btn btn-secondary">Edit</button>                    
								<button type="button" id='UNDOX' onclick="location.href='{{url('/pengajuan/edit/?idx=' .$idx. '&tipx=undo&flagz='.$flagz.'' )}}'" class="btn btn-info">Undo</button>  
								<button type="button" id='SAVEX' onclick='simpan()'   class="btn btn-success"<i class="fa fa-save"></i>Save</button>
							</div>
							
							<div class="col-md-3">
								<button type="button" id='HAPUSX'  onclick="hapusTrans()" class="btn btn-outline-danger">Hapus</button>
								<button type="button" id='CLOSEX'  onclick="location.href='{{url('/pengajuan?flagz='.$flagz.'' )}}'" class="btn btn-outline-secondary">Close</button>
							</div>
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
<!-- TAMBAH 1 -->

<script src="{{ asset('js/autoNumerics/autoNumeric.min.js') }}"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script> -->
<script src="{{asset('foxie_js_css/bootstrap.bundle.min.js')}}"></script>

<script>

	var idrow = 1;
	var baris = 1;
    function numberWithCommas(x) {
		return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
	}

// TAMBAH HITUNG
	$(document).ready(function() {

    idrow=<?=$no?>;
    baris=<?=$no?>;

		$("#TJUMLAH").autoNumeric('init', {aSign: '<?php echo ''; ?>',vMin: '-999999999.99'});

		jumlahdata = 100;
		for (i = 0; i <= jumlahdata; i++) {
			$("#JUMLAH" + i.toString()).autoNumeric('init', {aSign: '<?php echo ''; ?>', vMin: '-999999999.99'});
		}
		
		
		$('body').on('click', '.btn-delete', function() {
			var val = $(this).parents("tr").remove();
			baris--;
			nomor();
		});
		$(".date").datepicker({
			'dateFormat': 'dd-mm-yy',
		})
		
		
		$tipx = $('#tipx').val();
		
		
        if ( $tipx == 'new' )
		{
			 baru();			
		}

        if ( $tipx != 'new' )
		{
			 ganti();			
		}    
		
		
///////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////		
		
		
		//CHOOSE Bacno
 		var dTableBAccount1;
		loadDataBAccount1 = function(){
			$.ajax(
			{
				type: 'GET',    
				url: '{{url('account/browsecash')}}',
				success: function( response )
				{
					resp = response;
					if(dTableBAccount1){
						dTableBAccount1.clear();
					}
					for(i=0; i<resp.length; i++){
						
						dTableBAccount1.row.add([
							'<a href="javascript:void(0);" onclick="chooseAccount1(\''+resp[i].ACNO+'\',\''+resp[i].NAMA+'\')">'+resp[i].ACNO+'</a>',
							resp[i].NAMA,
						]);
					}
					dTableBAccount1.draw();
				}
			});
		}
		
		dTableBAccount1 = $("#table-baccount1").DataTable({
			
		});
		
		browseAccount1 = function(){
			loadDataBAccount1();
			$("#browseAccount1Modal").modal("show");
		}
		
		chooseAccount1 = function(ACNO,NAMA){
			$("#BACNO").val(ACNO);
			$("#BNAMA").val(NAMA);
			$("#browseAccount1Modal").modal("hide");
		}
		
		$("#BACNO").keypress(function(e){
			if(e.keyCode == 46){
				e.preventDefault();
				browseAccount1();
			}
		}); 
		
		
	
//////////////////////////////////////////////////////////////////////
		
 		var dTableBAccount;
		var rowidAccount;
		loadDataBAccount = function(){
			$.ajax(
			{
				type: 'GET',    
				url: "{{url('account/browse')}}",
				success: function( response )
				{
					resp = response;
					if(dTableBAccount){
						dTableBAccount.clear();
					}
					for(i=0; i<resp.length; i++){
						
						dTableBAccount.row.add([
							'<a href="javascript:void(0);" onclick="chooseAccount(\''+resp[i].ACNO+'\',\''+resp[i].NAMA+'\')">'+resp[i].ACNO+'</a>',
							resp[i].NAMA,
						]);
					}
					dTableBAccount.draw();
				}
			});
		}
		
		dTableBAccount = $("#table-baccount").DataTable({
			
		});
		
		browseAccount = function(rid){
			rowidAccount = rid;
			loadDataBAccount();
			$("#browseAccountModal").modal("show");
		}
		
		chooseAccount = function(ACNO,NAMA){
			$("#ACNO"+rowidAccount).val(ACNO);
			$("#NACNO"+rowidAccount).val(NAMA);
            $("#NACNO_KET").val(NAMA);		
            $("#ACNO_KET").val(ACNO);			
			$("#browseAccountModal").modal("hide");
		}
		
		
		$("#ACNO0").keypress(function(e){
			if(e.keyCode == 46){
				e.preventDefault();
				browseAccount(0);
			}
		}); 

//////////////////////////////////////////////////////////////////		
	var dTablePegawai;
		var rowidPegawai;
		loadDataBPegawai = function(){
			$.ajax(
			{
				type: 'GET',    
				url: "{{url('pegawai/browse')}}",
				success: function( response )
				{
					resp = response;
					if(dTableBPegawai){
						dTableBPegawai.clear();
					}
					for(i=0; i<resp.length; i++){
						
						dTableBPegawai.row.add([
							'<a href="javascript:void(0);" onclick="choosePegawai(\''+resp[i].KODEP+'\',\''+resp[i].NAMAP+'\' ,\''+resp[i].TOTAL+'\', \''+resp[i].BAYAR+'\' ,\''+resp[i].SISA+'\' )">'+resp[i].KODEP+'</a>',
							resp[i].NAMAP,
							//Intl.NumberFormat('en-US').format(resp[i].TOTAL),
							'<label for="pilihTotal" id="pilihTotal'+i+'" value="'+resp[i].TOTAL+'">'+Intl.NumberFormat('en-US').format(resp[i].TOTAL)+'</label>',
							Intl.NumberFormat('en-US').format(resp[i].BAYAR),
							//Intl.NumberFormat('en-US').format(resp[i].SISA),	
							'<label for="pilihSisa" id="pilihSisa'+i+'" value="'+resp[i].SISA+'">'+Intl.NumberFormat('en-US').format(resp[i].SISA)+'</label>',						
						]);
					}
					dTableBPegawai.draw();
				}
			});
		}
		
		dTableBPegawai = $("#table-bpegawai").DataTable({

			columnDefs: [
					{
                    className: "dt-right", 
					targets:  [2,3,4],
					render: $.fn.dataTable.render.number( ',', '.', 0, '' )
					}
			],
					
		});
		
		browsePegawai = function(rid){
			rowidPegawai = rid;
			loadDataBPegawai();
			$("#browsePegawaiModal").modal("show");
		}
		
		choosePegawai = function(kodep,namap){
			$("#KODEP"+rowidPegawai).val(kodep);
			$("#NAMAP"+rowidPegawai).val(namap);
            $("#KODEP_KET").val(kodep);		
            $("#NAMAP_KET").val(namap);					
			$("#browsePegawaiModal").modal("hide");
		}
		
		
		$("#KODEP0").keypress(function(e){
			if(e.keyCode == 46){
				e.preventDefault();
				browsePegawai(0);
			}
		}); 		
		

///////////////////////////////////////////////////////////////



	var dTableTrans;
		var rowidTrans;
		loadDataBTrans = function(){
			$.ajax(
			{
				type: 'GET',    
				url: "{{url('account/browsetrans')}}",
				data: 
				{
                    ACNO : $("#ACNO"+rowidTrans).val(),					   
				},
				success: function( response )
				{
					resp = response;
					if(dTableBTrans){
						dTableBTrans.clear();
					}
					for(i=0; i<resp.length; i++){
						
						dTableBTrans.row.add([
							'<a href="javascript:void(0);" onclick="chooseTrans(\''+resp[i].NO_BUKTI+'\',\''+resp[i].TGL+'\' ,\''+resp[i].KODE+'\', \''+resp[i].NAMA+'\' ,\''+resp[i].BAYAR+'\' ,\''+resp[i].ACNO+'\' ,\''+resp[i].NACNO+'\' ,\''+resp[i].URAIAN+'\' )">'+resp[i].NO_BUKTI+'</a>',
							resp[i].TGL,
							resp[i].KODE,
							resp[i].NAMA,
							//Intl.NumberFormat('en-US').format(resp[i].TOTAL),
							//'<label for="pilihTotal" id="pilihTotal'+i+'" value="'+resp[i].TOTAL+'">'+Intl.NumberFormat('en-US').format(resp[i].TOTAL)+'</label>',
							Intl.NumberFormat('en-US').format(resp[i].BAYAR),
							//Intl.NumberFormat('en-US').format(resp[i].SISA),	
							//'<label for="pilihSisa" id="pilihSisa'+i+'" value="'+resp[i].SISA+'">'+Intl.NumberFormat('en-US').format(resp[i].SISA)+'</label>',				
						]);
					}
					dTableBTrans.draw();
				}
			});
		}
		
		dTableBTrans = $("#table-btrans").DataTable({

			columnDefs: [
					{
                    className: "dt-right", 
					targets:  [4],
					render: $.fn.dataTable.render.number( ',', '.', 0, '' )
					}
			],
			
					
		});
		
		browseTrans = function(rid){
			rowidTrans = rid;
			loadDataBTrans();
			$("#browseTransModal").modal("show");
		}
		
		
		chooseTrans = function(NO_BUKTI, TGL, KODE, NAMA, BAYAR,  ACNO, NACNO, URAIAN ){
			$("#NO_TRANS"+rowidTrans).val(NO_BUKTI);
			$("#JUMLAH"+rowidTrans).val(BAYAR);
			$("#ACNO"+rowidTrans).val(ACNO);
			$("#NACNO"+rowidTrans).val(NACNO);
			$("#URAIAN"+rowidTrans).val(URAIAN);
		    $("#NACNO_KET").val(NACNO);		
			$("#ACNO_KET").val(ACNO);				
			$("#browseTransModal").modal("hide");
		}
		
		
		$("#NO_TRANS0").keypress(function(e){
			if(e.keyCode == 46){
				e.preventDefault();
				browseTrans(0);
			}
		}); 	
		

///////////////////////////////////////////////////////////

	

	
////////////////////////////////////////////////////////////////		
	});



//////////////////////////////////////////////////////////////////

	function cekDetail(){
		var cekAcno = '';
		$(".ACNO").each(function() {
			
			let z = $(this).closest('tr');
			var ACNOX = z.find('.ACNO').val();
			
			if( ACNOX =="" )
			{
					cekAcno = '1';
					
			}	
		});
		
		return cekAcno;
	}



///////////////////////////////////////


            function simpan() {

                hitung();

                var tgl = $('#TGL').val();
                var bulanPer = {{ session()->get('periode')['bulan'] }};
                var tahunPer = {{ session()->get('periode')['tahun'] }};

                var check = '0';

				if (cekDetail())
				{	
					check = '1';
					alert("Ada Akun# Kosong Didetail.");
				}
			
                if ($('#BACNO').val() == '') {
                    check = '1';
                    alert("Kas# Harus diisi.");
                }

                if (tgl.substring(3, 5) != bulanPer) {

                    check = '1';
                    alert("Bulan tidak sama dengan Periode");
                }

                if (tgl.substring(tgl.length - 4) != tahunPer) {
                    check = '1';
                    alert("Tahun tidak sama dengan Periode");

                }

                if (check == '0') {
                    $(".simpan").addClass("running");
                    document.getElementById("entri").submit();
                }
            }
	


    function nomor() {
		var i = 1;
		$(".REC").each(function() {
			$(this).val(i++);
		});
		hitung();
	}

    function hitung() {
		var TJUMLAH = 0;


		$(".JUMLAH").each(function() {
			var val = parseFloat($(this).val().replace(/,/g, ''));
			if(isNaN(val)) val = 0;
			TJUMLAH+=val;
		});
		
		if(isNaN(TJUMLAH)) TJUMLAH = 0;

		$('#TJUMLAH').val(numberWithCommas(TJUMLAH));
		$("#TJUMLAH").autoNumeric('update');

	}
	


	
	function baru() {
		
		 kosong();
		 hidup();
	
	}
	
	function ganti() {
		
		 mati();
	
	}
	
	function batal() {
		
		// alert($header[0]->NO_BUKTI);
		
		 //$('#NO_BUKTI').val($header[0]->NO_BUKTI);	
		 mati();
	
	}
	
	function hidup() {

		
		$("#TOPX").attr("disabled", true);
	    $("#PREVX").attr("disabled", true);
	    $("#NEXTX").attr("disabled", true);
	    $("#BOTTOMX").attr("disabled", true);

	    $("#NEWX").attr("disabled", true);
	    $("#EDITX").attr("disabled", true);
	    $("#UNDOX").attr("disabled", false);
	    $("#SAVEX").attr("disabled", false);
		
	    $("#HAPUSX").attr("disabled", true);
	    $("#CLOSEX").attr("disabled", true);
		
	    $("#PLUSX").attr("hidden", false);
		   
			$("#NO_BUKTI").attr("readonly", true);		   
			$("#TGL").attr("readonly", false);
			$("#ket1").attr("readonly", false);
			$("#ket2").attr("readonly", false);
			$("#ket3").attr("readonly", false);
			$("#ket4").attr("readonly", false);
			$("#ket5").attr("readonly", false);
			$("#ket6").attr("readonly", false);
			$("#ket7").attr("readonly", false);
			$("#ket8").attr("readonly", false);
			$("#ket9").attr("readonly", false);
			$("#ket10").attr("readonly", false);
		
		jumlahdata = 100;
		for (i = 0; i <= jumlahdata; i++) {
			$("#REC" + i.toString()).attr("readonly", true);
			$("#ARTICLE" + i.toString()).attr("readonly", false);
			$("#CUTTING" + i.toString()).attr("readonly", false);
			$("#EMBOS" + i.toString()).attr("readonly", false);
			$("#PSP" + i.toString()).attr("readonly", false);
			$("#JUKI" + i.toString()).attr("readonly", false);
			$("#JAHIT" + i.toString()).attr("readonly", false);
			$("#INJECT" + i.toString()).attr("readonly", false);
			$("#PACKING" + i.toString()).attr("readonly", false);
			$("#PSP_ASSB" + i.toString()).attr("readonly", false);
			$("#ASSEMBLING" + i.toString()).attr("readonly", false);
			$("#STOCKFIT" + i.toString()).attr("readonly", false);
			$("#PSP_CAT" + i.toString()).attr("readonly", false);
			$("#CAT_SPRAY" + i.toString()).attr("readonly", false);
			$("#PSP_FLOCK" + i.toString()).attr("readonly", false);
			$("#FLOCKING" + i.toString()).attr("readonly", false);
			$("#ASSB_PACKING" + i.toString()).attr("readonly", false);
			$("#COMP" + i.toString()).attr("readonly", false);
			$("#GILING" + i.toString()).attr("readonly", false);
			$("#CUTTING" + i.toString()).attr("readonly", false);
			$("#MICRO" + i.toString()).attr("readonly", false);
			$("#BORDIR" + i.toString()).attr("readonly", false);
			$("#DELETEX" + i.toString()).attr("hidden", false);
		}

		
	}


	function mati() {

		
	    $("#TOPX").attr("disabled", false);
	    $("#PREVX").attr("disabled", false);
	    $("#NEXTX").attr("disabled", false);
	    $("#BOTTOMX").attr("disabled", false);


	    $("#NEWX").attr("disabled", false);
	    $("#EDITX").attr("disabled", false);
	    $("#UNDOX").attr("disabled", true);
	    $("#SAVEX").attr("disabled", true);
	    $("#HAPUSX").attr("disabled", false);
	    $("#CLOSEX").attr("disabled", false);
		
	    $("#PLUSX").attr("hidden", true);
		
	    $(".NO_BUKTI").attr("readonly", true);	
		
		$("#TGL").attr("readonly", true);
		$("#ket1").attr("readonly", true);
		$("#ket2").attr("readonly", true);
		$("#ket3").attr("readonly", true);
		$("#ket4").attr("readonly", true);
		$("#ket5").attr("readonly", true);
		$("#ket6").attr("readonly", true);
		$("#ket7").attr("readonly", true);
		$("#ket8").attr("readonly", true);
		$("#ket9").attr("readonly", true);
		$("#ket10").attr("readonly", true);

		
		jumlahdata = 100;
		for (i = 0; i <= jumlahdata; i++) {
			$("#REC" + i.toString()).attr("readonly", true);
			$("#ARTICLE" + i.toString()).attr("readonly", true);
			$("#CUTTING" + i.toString()).attr("readonly", true);
			$("#EMBOS" + i.toString()).attr("readonly", true);
			$("#PSP" + i.toString()).attr("readonly", true);
			$("#JUKI" + i.toString()).attr("readonly", true);
			$("#JAHIT" + i.toString()).attr("readonly", true);
			$("#INJECT" + i.toString()).attr("readonly", true);
			$("#PACKING" + i.toString()).attr("readonly", true);
			$("#PSP_ASSB" + i.toString()).attr("readonly", true);
			$("#ASSEMBLING" + i.toString()).attr("readonly", true);
			$("#STOCKFIT" + i.toString()).attr("readonly", true);
			$("#PSP_CAT" + i.toString()).attr("readonly", true);
			$("#CAT_SPRAY" + i.toString()).attr("readonly", true);
			$("#PSP_FLOCK" + i.toString()).attr("readonly", true);
			$("#FLOCKING" + i.toString()).attr("readonly", true);
			$("#ASSB_PACKING" + i.toString()).attr("readonly", true);
			$("#COMP" + i.toString()).attr("readonly", true);
			$("#GILING" + i.toString()).attr("readonly", true);
			$("#CUTTING" + i.toString()).attr("readonly", true);
			$("#MICRO" + i.toString()).attr("readonly", true);
			$("#BORDIR" + i.toString()).attr("readonly", true);
			$("#BORDIR" + i.toString()).attr("readonly", true);
			$("#DELETEX" + i.toString()).attr("hidden", true);
		}
	}


	function kosong() {
				
		 $('#NO_BUKTI').val("+");	
	//	 $('#TGL').val("");		
		 $('#ket1').val("");	
		 $('#ket2').val("");		
		 $('#ket3').val("");		
		 $('#ket4').val("");		
		 $('#ket5').val("");		
		 $('#ket6').val("");		
		 $('#ket7').val("");		
		 $('#ket8').val("");		
		 $('#ket9').val("");		
		 $('#ket10').val("");		

		 
		var html = '';
		$('#detailx').html(html);	
		
	}
	
	function hapusTrans() {
		let text = "Hapus Transaksi "+$('#NO_BUKTI').val()+"?";
		if (confirm(text) == true) 
		{
			window.location ="{{url('/pengajuan/delete/'.$header->ROW_ID .'/?flagz='.$flagz.'' )}}";
			//return true;
		} 
		return false;
	}
	
	function CariBukti() {
		
		var flagz = "{{ $flagz }}";
		var cari = $("#CARI").val();
		var loc = "{{ url('/pengajuan/edit/') }}" + '?idx={{ $header->ROW_ID}}&tipx=search&flagz=' + encodeURIComponent(flagz) + '&buktix=' +encodeURIComponent(cari);
		window.location = loc;
		
	}


    function tambah() {

        // var x = document.getElementById('datatable').insertRow(baris + 1);
		
		// scroll atas bawah //
        var x = document.getElementById('datatable').getElementsByTagName('tbody')[0].insertRow();
		//

		html=`<tr>
				
				<td>
					<input type="hidden" name="ROW_ID[]" id="ROW_ID${idrow}" type="text" value=	"new" 
					class="form-control ROW_ID" onkeypress="return tabE(this,event)" readonly>
					
					<input name="REC[]" id="REC${idrow}" type="text"
					class="form-control REC" onkeypress="return tabE(this,event)" readonly>
					</td>
					<td>
						<input name="ARTICLE[]" id="ARTICLE${idrow}" type="text" value=""
							class="form-control ARTICLE " required>
					</td>
					<td {{( $flagz =='1IJ' || $flagz =='2CV' || $flagz =='2IJ' || $flagz =='3IJ' || $flagz =='2PY') ? '' : 'hidden' }}>
						<input name="CUTTING[]" onclick="select()" onkeyup="hitung()"
							id="CUTTING${idrow}" type="text" value="0"
							style="text-align: right"
							class="form-control CUTTING text-primary">
					</td>
					<td {{( $flagz =='1IJ' || $flagz =='2CV' || $flagz =='2IJ' || $flagz =='3IJ' || $flagz =='2AB' || $flagz =='2PY') ? '' : 'hidden' }}>
						<input name="EMBOS[]" onclick="select()" onkeyup="hitung()"
							id="EMBOS${idrow}" type="text" value="0"
							style="text-align: right " 
							class="form-control EMBOSS text-primary">
					</td>
					<td {{( $flagz =='1IJ' || $flagz =='2CV' || $flagz =='2IJ' || $flagz =='3IJ' || $flagz =='2AB') ? '' : 'hidden' }}>
						<input name="PSP[]" onclick="select()" onkeyup="hitung()"
							id="PSP${idrow}" type="text" value="0"
							style="text-align: right " 
							class="form-control PSP text-primary">
					</td>
					<td {{( $flagz =='1IJ' || $flagz =='2IJ' || $flagz =='3IJ') ? '' : 'hidden' }}>
						<input name="JUKI[]" onclick="select()" onkeyup="hitung()"
							id="JUKI${idrow}" type="text" value="0"
							style="text-align: right " 
							class="form-control JUKI text-primary">
					</td>
					<td {{( $flagz =='1IJ' || $flagz =='2IJ' || $flagz =='3IJ' || $flagz =='2PY') ? '' : 'hidden' }}>
						<input name="JAHIT[]" onclick="select()" onkeyup="hitung()"
							id="JAHIT${idrow}" type="text" value="0"
							style="text-align: right " 
							class="form-control JAHIT text-primary">
					</td>
					<td {{( $flagz =='1IJ' || $flagz =='2IJ' || $flagz =='3IJ' || $flagz =='2AB' || $flagz =='2PY') ? '' : 'hidden' }}>
						<input name="INJECT[]" onclick="select()" onkeyup="hitung()"
							id="INJECT${idrow}" type="text" value="0"
							style="text-align: right " 
							class="form-control INJECT text-primary">
					</td>
					<td {{( $flagz =='1IJ' || $flagz =='2IJ' || $flagz =='3IJ' || $flagz =='2CV' || $flagz =='2CM') ? '' : 'hidden' }}>
						<input name="PACKING[]" onclick="select()" onkeyup="hitung()"
							id="PACKING${idrow}" type="text" value="0"
							style="text-align: right " 
							class="form-control PACKING text-primary">
					</td>
					<td {{( $flagz =='2CV') ? '' : 'hidden' }}>
						<input name="PSP_ASSB[]" onclick="select()" onkeyup="hitung()"
							id="PSP_ASSB${idrow}" type="text" value="0"
							style="text-align: right " 
							class="form-control PSP_ASSB text-primary">
					</td>
					<td {{( $flagz =='2CV' || $flagz =='2CM' ) ? '' : 'hidden' }}>
						<input name="ASSEMBLING[]" onclick="select()" onkeyup="hitung()"
							id="ASSEMBLING${idrow}" type="text" value="0"
							style="text-align: right " 
							class="form-control ASSEMBLING text-primary">
					</td>
					<td {{( $flagz =='2CM' ) ? '' : 'hidden' }}>
						<input name="STOCKFIT[]" onclick="select()" onkeyup="hitung()"
							id="STOCKFIT${idrow}" type="text" value="0"
							style="text-align: right " 
							class="form-control STOCKFIT text-primary">
					</td>
					<td {{( $flagz =='2AB') ? '' : 'hidden' }}>
						<input name="PSP_CAT[]" onclick="select()" onkeyup="hitung()"
							id="PSP_CAT${idrow}" type="text" value="0"
							style="text-align: right " 
							class="form-control PSP_CAT text-primary">
					</td>
					<td {{( $flagz =='2AB' || $flagz =='2PY' ) ? '' : 'hidden' }}>
						<input name="CAT_SPRAY[]" onclick="select()" onkeyup="hitung()"
							id="CAT_SPRAY${idrow}" type="text" value="0"
							style="text-align: right " 
							class="form-control CAT_SPRAY text-primary">
					</td>
					<td {{( $flagz =='2AB') ? '' : 'hidden' }}>
						<input name="PSP_FLOCK[]" onclick="select()" onkeyup="hitung()"
							id="PSP_FLOCK${idrow}" type="text" value="0"
							style="text-align: right " 
							class="form-control PSP_FLOCK text-primary">
					</td>
					<td {{( $flagz =='2AB') ? '' : 'hidden' }}>
						<input name="FLOCKING[]" onclick="select()" onkeyup="hitung()"
							id="FLOCKING${idrow}" type="text" value="0"
							style="text-align: right " 
							class="form-control FLOCKING text-primary">
					</td>
					<td {{( $flagz =='2AB' || $flagz =='2PY') ? '' : 'hidden' }}>
						<input name="ASSB_PACKING[]" onclick="select()" onkeyup="hitung()"
							id="ASSB_PACKING${idrow}" type="text" value="0"
							style="text-align: right " 
							class="form-control ASSB_PACKING text-primary">
					</td>
					<td {{( $flagz =='2AB') ? '' : 'hidden' }}>
						<input name="COMP[]" onclick="select()" onkeyup="hitung()"
							id="COMP${idrow}" type="text" value="0"
							style="text-align: right " 
							class="form-control COMP text-primary">
					</td>
					<td {{( $flagz =='2AB') ? '' : 'hidden' }}>
						<input name="GILING[]" onclick="select()" onkeyup="hitung()"
							id="GILING${idrow}" type="text" value="0"
							style="text-align: right " 
							class="form-control GILING text-primary">
					</td>
					<td {{( $flagz =='2PY') ? '' : 'hidden' }}>
						<input name="MICRO[]" onclick="select()" onkeyup="hitung()"
							id="MICRO${idrow}" type="text" value="0"
							style="text-align: right " 
							class="form-control MICRO text-primary">
					</td>
		<!--		<td {{( $flagz =='4IJ') ? '' : 'hidden' }}>
						<input name="BORDIR[]" onclick="select()" onkeyup="hitung()"
							id="BORDIR${idrow}" type="text" value="0"
							style="text-align: right " 
							class="form-control BORDIR text-primary">
					</td>
		-->
					<td>
						<button type="button" class="btn btn-sm btn-circle btn-outline-danger btn-delete" id='DELETEX${idrow}' onclick=''>
							<i class="fa fa-fw fa-trash"></i>
						</button>
					</td>		
         </tr>`;
				
        x.innerHTML = html;
        var html='';
		
		jumlahdata = 100;
		for (i = 0; i <= jumlahdata; i++) {
			$("#CUTTING" + i.toString()).autoNumeric('init', {
				aSign: '<?php echo ''; ?>',
				vMin: '-999999999.99'
			});
			$("#EMBOS" + i.toString()).autoNumeric('init', {
				aSign: '<?php echo ''; ?>',
				vMin: '-999999999.99'
			});
			$("#PSP" + i.toString()).autoNumeric('init', {
				aSign: '<?php echo ''; ?>',
				vMin: '-999999999.99'
			});
			$("#JUKI" + i.toString()).autoNumeric('init', {
				aSign: '<?php echo ''; ?>',
				vMin: '-999999999.99'
			});
			$("#JAHIT" + i.toString()).autoNumeric('init', {
				aSign: '<?php echo ''; ?>',
				vMin: '-999999999.99'
			});
			$("#INJECT" + i.toString()).autoNumeric('init', {
				aSign: '<?php echo ''; ?>',
				vMin: '-999999999.99'
			});
			$("#PACKING" + i.toString()).autoNumeric('init', {
				aSign: '<?php echo ''; ?>',
				vMin: '-999999999.99'
			});
			$("#PSP_ASEMB" + i.toString()).autoNumeric('init', {
				aSign: '<?php echo ''; ?>',
				vMin: '-999999999.99'
			});
			$("#ASSEMBLING" + i.toString()).autoNumeric('init', {
				aSign: '<?php echo ''; ?>',
				vMin: '-999999999.99'
			});
			$("#STOCKFIT" + i.toString()).autoNumeric('init', {
				aSign: '<?php echo ''; ?>',
				vMin: '-999999999.99'
			});
			$("#PSP_CAT" + i.toString()).autoNumeric('init', {
				aSign: '<?php echo ''; ?>',
				vMin: '-999999999.99'
			});
			$("#CAT_SPRAY" + i.toString()).autoNumeric('init', {
				aSign: '<?php echo ''; ?>',
				vMin: '-999999999.99'
			});
			$("#PSP_FLOCK" + i.toString()).autoNumeric('init', {
				aSign: '<?php echo ''; ?>',
				vMin: '-999999999.99'
			});
			$("#FLOCKING" + i.toString()).autoNumeric('init', {
				aSign: '<?php echo ''; ?>',
				vMin: '-999999999.99'
			});
			$("#ASS_PACKING" + i.toString()).autoNumeric('init', {
				aSign: '<?php echo ''; ?>',
				vMin: '-999999999.99'
			});
			$("#COMP" + i.toString()).autoNumeric('init', {
				aSign: '<?php echo ''; ?>',
				vMin: '-999999999.99'
			});
			$("#GILING" + i.toString()).autoNumeric('init', {
				aSign: '<?php echo ''; ?>',
				vMin: '-999999999.99'
			});
			$("#CUTTING" + i.toString()).autoNumeric('init', {
				aSign: '<?php echo ''; ?>',
				vMin: '-999999999.99'
			});
			$("#MICRO" + i.toString()).autoNumeric('init', {
				aSign: '<?php echo ''; ?>',
				vMin: '-999999999.99'
			});
			$("#BORDIR" + i.toString()).autoNumeric('init', {
				aSign: '<?php echo ''; ?>',
				vMin: '-999999999.99'
			});
			$("#PSP_ASSB" + i.toString()).autoNumeric('init', {
				aSign: '<?php echo ''; ?>',
				vMin: '-999999999.99'
			});
			$("#ASSB_PACKING" + i.toString()).autoNumeric('init', {
				aSign: '<?php echo ''; ?>',
				vMin: '-999999999.99'
			});
		}
		
		
		$("#ACNO"+idrow).keypress(function(e){
			if(e.keyCode == 46){
				e.preventDefault();
				browseAccount(eval($(this).data("rowid")));
			}
		}); 
		

		idrow++;
		baris++;
		nomor();

		$(".ronly").on('keydown paste', function(e) {
			e.preventDefault();
			e.currentTarget.blur();
		});
    }
	 
	function btVerifikasi1() {
		if ( $tipx != 'new' )
		{	
			if (confirm("Yakin Verifikasi?")) {
				window.location.replace('{{route("pengajuan.validasi1",$header->ROW_ID ?? '')}}');
			}
		}
	}

	function btVerifikasi2() {
		if ( $tipx != 'new' )
		{	
			if (confirm("Yakin Verifikasi?")) {
				window.location.replace('{{route("pengajuan.validasi2",$header->ROW_ID ?? '')}}');
			}
		}
       
	}

	function btVerifikasi3() {
		if ( $tipx != 'new' )
		{
			if (confirm("Yakin Verifikasi?")) {
				window.location.replace('{{route("pengajuan.validasi3",$header->ROW_ID ?? '')}}');
			}
		}
	}

	function btVerifikasi4() {
		if ( $tipx != 'new' )
		{	
			if (confirm("Yakin Verifikasi?")) {
				window.location.replace('{{route("pengajuan.validasi4",$header->ROW_ID ?? '')}}');
			}
		}
	}

	function btVerifikasi5() {
		if ( $tipx != 'new' )
		{
			if (confirm("Yakin Verifikasi?")) {
				window.location.replace('{{route("pengajuan.validasi5",$header->ROW_ID ?? '')}}');
			}
		}
	} 
</script>
@endsection
