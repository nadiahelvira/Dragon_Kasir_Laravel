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

class RAnalisaController extends Controller
{

    public function report()
    {
		// $acno = Account::where('BNK', '2')->get();
		// session()->put('filter_tglDari', date("d-m-Y"));
		// session()->put('filter_tglSampai', date("d-m-Y"));
		session()->put('filter_kodes1', '');
		// session()->put('filter_type', '-');
		// session()->put('filter_acno1', '');

        return view('freport_analisa.report')->with(['hasil' => []]);
    }
	 
	 
	public function jasperAnalisaReport(Request $request) 
	{
	    $file 	= 'bankn';
		$PHPJasperXML = new PHPJasperXML();
		$PHPJasperXML->load_xml_file(base_path() . ('/app/reportc01/phpjasperxml/' . $file . '.jrxml'));

		// Check Filter
		
		if (!empty($request->KODES))
		{
			$filterkodes = " and BANK.KODES ='".$request->KODES."' ";
		}

		$kodes = $request->kodes;

		$queryakum = DB::SELECT("SET @akum:=0;");
		$query = DB::SELECT(
		"SELECT 'Kodes' AS KODES,
				'Tanggal' AS TGL,
				'No Bukti' AS NO_BUKTI,
				'No PB' AS NO_PB,
				0 AS SISA
		FROM bank
		WHERE bank.NO_BUKTI=bankd.NO_BUKTI $filterkodes
		ORDER BY bank.NO_BUKTI"
		);

		// kembalikan filter2-an

		session()->put('filter_type', $request->TYPE);
		
		if($request->has('filter'))
		{
			return view('freport_analisa.report')->with(['hasil' => $query]);
		}
		
		$data = [];
		foreach ($query as $key => $value) {
			array_push($data, array(
				'NO_BUKTI' => $query[$key]->NO_BUKTI,
				'TGL' => $query[$key]->TGL,
				'DEBET' => $query[$key]->DEBET,
				'KREDIT' => $query[$key]->KREDIT,
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
		));


		$PHPJasperXML->setData($data);
		ob_end_clean();
		$PHPJasperXML->outpage("I");
		
	}
	
	

	
}
