<?php

namespace App\Http\Controllers\Api;

use DB;
use Throwable;
use App\Models\Master\Truck;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class AccApiController extends Controller
{
	public function List_PO(Request $request)
	{
		

		$po  =  DB::SELECT("
		Select PO.NO_BUKTI , PO.TGL, PO.KODES, PO.NAMAS, PO.ALAMAT, PO.KOTA, POD.KD_BRG, POD.NA_BRG, POD.QTY, POD.KIRIM, POD.SISA, POD.HARGA, POD.KODET, POD.NOPOL, POD.KET from PO, POD WHERE PO.NO_BUKTI = POD.NO_BUKTI AND POD.SISA > 0 ;
		");
		
		$data = [
			'success'   => true,
			'data'      => $po
		];

		return response()->json($data);
	}

	public function List_PO_ID(Request $request)
	{
		$filterpo=''; 
		
		if (!empty( $request->no_po ))
			{
				$filterpo = " and PO.NO_BUKTI ='".$request->no_po."' ";
			}
			
		$po  =  DB::SELECT("
		Select PO.NO_BUKTI , PO.TGL, PO.KODES, PO.NAMAS, PO.ALAMAT, PO.KOTA, POD.KD_BRG, POD.NA_BRG, POD.QTY, POD.KIRIM, POD.SISA, POD.HARGA, POD.KODET, POD.NOPOL, POD.KET from PO, POD WHERE PO.NO_BUKTI = POD.NO_BUKTI $filterpo AND POD.SISA > 0  ;
		");
		
		$data = [
			'success'   => true,
			'data'      => $po
		];

		return response()->json($data);
	}
	
			
	public function pp_bengkel(Request $request)
    {
		$request = json_decode($request->getContent());
		$tanggal = date("Y-m-d");

		$bulan = substr($tanggal,5,2);
		$tahun = substr($tanggal,0,4);
		$per = $bulan.'/'.$tahun;

		$query = DB::table("pp")->select(DB::raw("MAX(RIGHT(TRIM(NO_BUKTI),4)) as NOMER"))->where("PER",$per)->first();


		$nomer = 0;
		if ($query != []) {
			$nomer = $query->NOMER;
		}
		
		$nomer1 = str_pad($nomer + 1, 4, 0, STR_PAD_LEFT);
		$no_bukti ='SPP'.$tahun.$bulan.'-'.$nomer1;

		$rec1 = 1;
		$total_qty =0;
		$total_total =0;
		$total_total2 =0;
			try 
			{
				foreach ($request->data as $key => $value)
				{
					$no_req = $value->no_req;
					$usrnm = $value->username;
					$type01 = $value->type;
					$kd_brg = $value->kd_brg;
					$na_brg = $value->na_brg;
					$qty = $value->qty;
					$ket = $value->ket;
					$kodet = $value->kodet;
					$nopol = $value->nopol;
					$harga = $value->harga;
					$kodes = $value->kodes;
					$namas = $value->namas;
					$satuan = $value->satuan;
					///////////////////////////////////////////////////////
		
					$total = $qty * $harga;
	
					DB::SELECT("INSERT INTO PPD (NO_BUKTI, REC, KD_BRG, NA_BRG, QTY, SATUAN, FLAG, GOL, PER, HARGA, TOTAL, 
								HARGA2, TOTAL2, KODES, NAMAS, KODES2, NAMAS2, KET, KODET, NOPOL ) 
								VALUES ('".$no_bukti."','".$rec1."','".$kd_brg."','".$na_brg."', '".$qty."', '".$satuan."','PP', 'Y', '".$per."', '".$harga."', '".$total."', 
								'".$harga."', '".$total."','".$kodes."', '".$namas."', '".$kodes."', '".$namas."', '".$ket."', '".$kodet."', '".$nopol."' )
							");
			
					$rec1 = $rec1 + 1;
				}
		
				$total_qty = $total_qty + $qty;	
				$total_total = $total_total + $total;
				$total2 = 0;
				$total_total2 = $total_total2 + $total2;	
		
				DB::SELECT("INSERT INTO PP (NO_BUKTI, TGL, PER, TYPE01, FLAG, GOL, TOTAL_QTY, TOTAL, TOTAL2, NO_SPK, created_by ) 
							VALUES ('".$no_bukti."','".$tanggal."','".$per."','".$type01."','PP', 'Y', '".$total_qty."', '".$total_total."','".$total2."','".$no_req."', '".$usrnm."' )
						");
						
				$data = [
					'success'   => true,
					'message'   => 'Data PP diterima'
					
				];
			}
			catch (Throwable $e)
			{
				$data = [
					'success'   => false,
					'message'   => 'Data PP belum berhasil diterima'
					
					
				];
			}

                return response()->json($data);
    }

	public function beli_bengkel(Request $request)
    {
		$request = json_decode($request->getContent());
		$tanggal = date("Y-m-d");
    
		$bulan = substr($tanggal,5,2);
		$tahun = substr($tanggal,0,4);
		$per = $bulan.'/'.$tahun;
		
		$query = DB::table("beli")->select(DB::raw("MAX(RIGHT(TRIM(NO_BUKTI),4)) as NOMER"))->where("PER",$per)->first();
		
		$nomer = 0;
		if ($query != []) {
			$nomer = $query->NOMER;
		}
		$nomer1 = str_pad($nomer + 1, 4, 0, STR_PAD_LEFT);
		$no_bukti ='SBL'.$tahun.$bulan.'-'.$nomer1;

		$rec1 = 1;
		$total_qty =0;
		$total_total =0;
		$no_po = '';
		
		try 
		{
			foreach ($request->data as $key => $value)
			{
				$no_po = $value->no_po;
				$usrnm = $value->username;
				$type01 = $value->type;
				$kd_brg = $value->kd_brg;
				$na_brg = $value->na_brg;
				$qty = $value->qty;
				$satuan = $value->satuan;
				$ket = $value->ket;

				$resultxx = DB::table("pod")->select("HARGA", "KODET", "NOPOL")->where("NO_BUKTI",$no_po)->where("KD_BRG",$kd_brg)->where("KET",$ket)->first();
				
				$harga = 0;
				$kodet = '';
				$nopol = '';
				
				if ($resultxx != []) {
					$harga = $resultxx->HARGA;
					$kodet = $resultxx->KODET;
					$nopol = $resultxx->NOPOL;
				}
				///////////////////////////////////////////////
				$total = $qty * $harga;
				$insertbelid = DB::SELECT("INSERT INTO BELID (NO_BUKTI, REC, KD_BRG, NA_BRG, QTY, SATUAN, FLAG, GOL, PER, HARGA, TOTAL, KET, 
								KODET, NOPOL ) 
								VALUES ('".$no_bukti."','".$rec1."','".$kd_brg."','".$na_brg."', '".$qty."', '".$satuan."','BL', 'Y', '".$per."', '".$harga."', '".$total."', '".$ket."', '".$kodet."', '".$nopol."' )
								");
								
				$total_qty = $total_qty + $qty;	
				$total_total = $total_total + $total;		
				$rec1 = $rec1 + 1;
			}
		
			$resultxx1 = DB::table("po")->select("KODES", "NAMAS", "ALAMAT", "KOTA", "PN")->where("NO_BUKTI",$no_po)->first();
		
			$kodes = '';
			$namas = '';
			$alamat = '';
			$kota = '';
			$pn = '';
			
			if ($resultxx1 != []) 
			{
				$kodes = $resultxx1->KODES;
				$namas = $resultxx1->NAMAS;
				$alamat = $resultxx1->ALAMAT;			
				$kota = $resultxx1->KOTA;
				$pn = $resultxx1->PN;
			}
			
			$ppn = 0;
			$nett = $total_total;
			
			if ( $pn =='1' )
			{
				$ppn = 0.11 * $total_total;
				$nett = $total_total + $ppn;
				
			}
			
			DB::SELECT("INSERT INTO BELI (NO_BUKTI, TGL, PER, TYPE01, FLAG, GOL, KODES, NAMAS, ALAMAT, KOTA, PN, TOTAL_QTY, TOTAL, PPN, NETT, SISA,  created_by ) 
						VALUES ('".$no_bukti."','".$tanggal."','".$per."','".$type01."','BL', 'Y', '".$kodes."', '".$namas."', '".$alamat."', '".$kota."', '".$pn."',  '".$total_qty."', '".$total_total."','".$ppn."', '".$nett."', '".$nett."' , '".$usrnm."' )
						");

			$data = [
				'success'   => true,
				'message'   => 'Data barang masuk diterima.'
				
			];
		
		}
		catch (Throwable $e)
		{
			
			$data = [
				'success'   => false,
				'message'   => ' Data Barang Masuk Masih Gagal.'
				
			];
		}

        return response()->json($data);
    }


///////////////////////////////////////////////////////////////////////////////




	public function keluar_bengkel(Request $request)
    {
		$request = json_decode($request->getContent());
		$tanggal = date("Y-m-d");
    
		$bulan = substr($tanggal,5,2);
		$tahun = substr($tanggal,0,4);
		$per = $bulan.'/'.$tahun;
		
		$query = DB::table("pakai")->select(DB::raw("MAX(RIGHT(TRIM(NO_BUKTI),4)) as NOMER"))->where("PER",$per)->first();
		
		$nomer = 0;
		if ($query != []) {
			$nomer = $query->NOMER;
		}
		$nomer1 = str_pad($nomer + 1, 4, 0, STR_PAD_LEFT);
		$no_bukti ='ZPK'.$tahun.$bulan.'-'.$nomer1;

		$rec1 = 1;
		$total_qty =0;
		$total_total =0;
		$no_po = '';
		
		try 
		{
			foreach ($request->data as $key => $value)
			{
				//$no_bukti = $value->no_bukti;
				$usrnm = $value->username;
				$kd_brg = $value->kd_brg;
				$na_brg = $value->na_brg;
				$kodet = $value->kodet;
				$nopol = $value->nopol;
				$no_spk = $value->no_spk;
				$qty = $value->qty;
				$satuan = $value->satuan;
				$ket = $value->ket;

				
				$insertpakaid = DB::SELECT("INSERT INTO PAKAID (NO_BUKTI, REC, KD_BRG, NA_BRG, QTY, SATUAN, FLAG, GOL, PER ) 
								VALUES ('".$no_bukti."','".$rec1."','".$kd_brg."','".$na_brg."', '".$qty."', '".$satuan."','PK', 'Y', '".$per."' )
								");
								
				$total_qty = $total_qty + $qty;		
				$rec1 = $rec1 + 1;
			}
		
			
			
			DB::SELECT("INSERT INTO PAKAI (NO_BUKTI, TGL, PER, FLAG, GOL,  TOTAL_QTY,  created_by ) 
						VALUES ('".$no_bukti."','".$tanggal."','".$per."','PK', 'Y', '".$total_qty."', '".$usrnm."' )
						");

			$data = [
				'success'   => true,
				'message'   => 'Data barang keluar diterima.'
				
			];
		
		}
		catch (Throwable $e)
		{
			
			$data = [
				'success'   => false,
				'message'   => 'Data Barang Keluar Masih Gagal.'
				
			];
		}

        return response()->json($data);
    }
	




    // Outbond

    // Test
    // public function test(Request $request)
    // {
    //     $response = Http::get('https://lookmandjaja.com/programweb/breeze/public/api/vendor/suppliers');

    //     // $data = [
    //     //     'kode'  => $response['kode'],
    //     //     'nama'  => $response['nama'],
    //     // ];

    //     return $response['sup'];
    // }


}
