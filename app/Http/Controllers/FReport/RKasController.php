<?php

namespace App\Http\Controllers\FReport;

use App\Http\Controllers\Controller;
use App\Models\FMaster\Account;
use App\Models\Master\Perid;

use Carbon\Carbon;
use Illuminate\Http\Request;
use DataTables;
use Auth;
use DB;

include_once base_path()."/vendor/simitgroup/phpjasperxml/version/1.1/PHPJasperXML.inc.php";
use PHPJasperXML;

use \koolreport\laravel\Friendship;
use \koolreport\bootstrap4\Theme;

class RKasController extends Controller
{
	
	public function report()
	{
		$acno = Account::where('BNK', '1')->get();
		session()->put('filter_tglDari', date("d-m-Y"));
		session()->put('filter_tglSampai', date("d-m-Y"));
		session()->put('filter_acno1', '');
		session()->put('filter_type', '-');
		session()->put('filter_nobukti1', '');
		session()->put('filter_nobukti2', 'ZZZ');
		session()->put('filter_pilih', '');

		return view('freport_kas.report')->with(['acno' => $acno])->with(['hasil' => []]);
	}

	public function jasperKasReport(Request $request)
	{

		if (  $request->PILIH == '1' )
		{
			$file 	= 'Laporan_JurnalKas';
		} else if (  $request->PILIH == '2' )
		{
			$file 	= 'Laporan_KasKeluarPendekPerBukti';
		} else if (  $request->PILIH == '3' )
		{
			$file 	= 'Laporan_KasPerNoBukti';
		} else
		{
			$file = '';
		}

		// $file 	= 'kasn';
		$PHPJasperXML = new PHPJasperXML();
		$PHPJasperXML->load_xml_file(base_path() . ('/app/reportc01/phpjasperxml/' . $file . '.jrxml'));
		
		// Check Filter
		
		if (!empty($request->tglDr) && !empty($request->tglSmp))
		{
			$tglDrD = date("Y-m-d", strtotime($request->tglDr));
			$tglSmpD = date("Y-m-d", strtotime($request->tglSmp));
			$filtertgl = " AND KAS.TGL between '".$tglDrD."' and '".$tglSmpD."' ";
		}
		
		if ( $request->TYPE != '-' )
		{
			$filtertype = " and KAS.TYPE ='".$request->TYPE."' ";
		}
		
		if (!empty($request->ACNO))
		{
			$filteracno = " and KAS.BACNO ='".$request->BACNO."' ";
		}
		
		if (!empty($request->nobukti1) && !empty($request->nobukti2))
		{
			$nobukti1x = $request->nobukti1;
			$nobukti2x = $request->nobukti2;
			$filternobukti = " AND KAS.NO_BUKTI between '".$nobukti1x."' and '".$nobukti2x."'  ";
		}

		$queryakum = DB::SELECT("SET @akum:=0;");
		$query = DB::SELECT(
		"SELECT kas.NO_BUKTI, 
			DATE_FORMAT(kas.TGL,'%d/%m/%Y') AS TGL,
			CONVERT(kas.TGL,DATE) AS TGLX,
			kas.BACNO,
			kas.BNAMA,
			kasd.ACNO,
			kasd.NACNO,
			kasd.URAIAN,
			0 AS AWAL, 
			kasd.DEBET,
			kasd.KREDIT,
			kasd.JUMLAH,
			IF(kas.TYPE='BKM',1,2) AS BARIS,
			kas.TYPE 
		FROM kas, kasd 
		WHERE kas.NO_BUKTI=kasd.NO_BUKTI $filtertgl	$filtertype $filteracno $filternobukti"
		);

		// kembalikan filter2-an
	
		$acno = Account::where('BNK','1')->get();
		session()->put('filter_acno1', $request->ACNO);
		session()->put('filter_tglDari', $request->tglDr);
		session()->put('filter_tglSampai', $request->tglSmp);
		session()->put('filter_type', $request->TYPE);
		session()->put('filter_nobukti1', $request->nobukti1);
		session()->put('filter_nobukti2', $request->nobukti2);

		if($request->has('filter'))
		{
			return view('freport_kas.report')->with(['acno' => $acno])->with(['hasil' => $query]);
		}
		
		$data = [];
		foreach ($query as $key => $value) {
			array_push($data, array(
				'NO_BUKTI' => $query[$key]->NO_BUKTI,
				'TGL' => $query[$key]->TGL,
				'MASUK' => $query[$key]->DEBET,
				'KELUAR' => $query[$key]->KREDIT,
				'DEBET' => $query[$key]->DEBET,
				'KREDIT' => $query[$key]->KREDIT,
				'KASDEBET' => $query[$key]->DEBET,
				'KASKREDIT' => $query[$key]->KREDIT,
				'JUMLAH' => $query[$key]->JUMLAH,
				'ACNO' => $query[$key]->ACNO,
				'NACNO' => $query[$key]->NACNO,
				'URAIAN' => $query[$key]->URAIAN,
				'SALDO' => $query[$key]->SALDO
			));
		}

		array_push($data, array(
			'NO_BUKTI' => '',
			'TGL' => $tglSmpD,
			'AWAL' => $xawal1,
			'TYPE' => $type,
			'URAIAN' => $uraian,
			'no' => $nobukti1,
		));


		$PHPJasperXML->setData($data);
		ob_end_clean();
		$PHPJasperXML->outpage("I");
	}
}
