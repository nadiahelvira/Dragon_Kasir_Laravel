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

class RLihatpnpbController extends Controller
{

    public function report()
    {
		$per = Perid::query()->get();
		session()->put('filter_periode', '');
		session()->put('filter_type', '-');
		// session()->put('filter_acno1', '');
        return view('freport_lihatpnpb.report')->with(['per' => $per])->with(['hasil' => []]);
    }
	 
	 
	public function jasperLihatpnpbReport(Request $request) 
	{
	    $file 	= '';
		$PHPJasperXML = new PHPJasperXML();
		$PHPJasperXML->load_xml_file(base_path() . ('/app/reportc01/phpjasperxml/' . $file . '.jrxml'));


		if($request['perio'])
		{
			$periode = $request['perio'];
		}
		
		$per = $periode;
		$type = $request->TYPE;

		$queryakum = DB::SELECT("SET @akum:=0;");
		if ($type == 'BKM') {
			$query = DB::SELECT(
				"SELECT kas.NO_BUKTI AS NO_BUKTI,
						kas.TYPE AS TYP,
						kas.TGL AS TGL,
						kasd.ACNO AS ACNO,
						kasd.URAIAN AS URAIAN,
						kasd.DEBET AS DEBET,
						kasd.KREDIT AS KREDIT,
						kasd.NO_FKTR AS NO_PB
					FROM kas, kasd where
					kas.NO_BUKTI = kasd.NO_BUKTI
					AND kas.PER='$per'					
					AND kasd.NO_FKTR <> ''
					AND kas.TYPE='BKM'
					ORDER BY NO_BUKTI");
		} else if ($type == 'BKK') {
			$query = DB::SELECT(
				"SELECT kas.NO_BUKTI AS NO_BUKTI,
						kas.TYPE AS TYP,
						kas.TGL AS TGL,
						kasd.ACNO AS ACNO,
						kasd.URAIAN AS URAIAN,
						kasd.DEBET AS DEBET,
						kasd.KREDIT AS KREDIT,
						kasd.NO_FKTR AS NO_PB
					FROM kas, kasd
					WHERE kas.NO_BUKTI = kasd.NO_BUKTI
					AND kas.PER='$per'					
					AND kasd.NO_FKTR <> ''
					AND kas.TYPE='BKK'
					ORDER BY NO_BUKTI");
		} else if ($type == 'BBM') {
			$query = DB::SELECT(
				"SELECT bank.NO_BUKTI AS NO_BUKTI,
						bank.TYPE AS TYP,
						bank.TGL AS TGL,
						bankd.ACNO AS ACNO,
						bankd.URAIAN AS URAIAN,
						bankd.DEBET AS DEBET,
						bankd.KREDIT AS KREDIT,
						bankd.NO_HUT AS NO_PB
					FROM bank, bankd
					WHERE bank.NO_BUKTI = bankd.NO_BUKTI
					AND bank.PER='$per'
					AND bankd.NO_HUT <> ''
					AND bank.TYPE='BBM'
					ORDER BY NO_BUKTI");
		} else if ($type == 'BBK') {
			$query = DB::SELECT(
				"SELECT bank.NO_BUKTI AS NO_BUKTI,
						bank.TYPE AS TYP,
						bank.TGL AS TGL,
						bankd.ACNO AS ACNO,
						bankd.URAIAN AS URAIAN,
						bankd.DEBET AS DEBET,
						bankd.KREDIT AS KREDIT,
						bankd.NO_HUT AS NO_PB
					FROM bank, bankd
					WHERE bank.NO_BUKTI = bankd.NO_BUKTI
					AND bank.PER='$per'					
					AND bankd.NO_HUT <> ''
					AND bank.TYPE='BBK'
					ORDER BY NO_BUKTI");
		} else {
			$query = DB::SELECT(
				"SELECT NO_BUKTI, TYP, TGL, ACNO, URAIAN, DEBET, KREDIT, NO_PB FROM
				( SELECT bank.NO_BUKTI AS NO_BUKTI,
						bank.TYPE AS TYP,
						bank.TGL AS TGL,
						bankd.ACNO AS ACNO,
						bankd.URAIAN AS URAIAN,
						bankd.DEBET AS DEBET,
						bankd.KREDIT AS KREDIT,
						bankd.NO_HUT AS NO_PB
					FROM bank, bankd
					WHERE bank.NO_BUKTI = bankd.NO_BUKTI
					AND bank.PER='$per'
					AND bankd.NO_HUT <> ''
				UNION ALL
				SELECT kas.NO_BUKTI AS NO_BUKTI,
						kas.TYPE AS TYP,
						kas.TGL AS TGL,
						kasd.ACNO AS ACNO,
						kasd.URAIAN AS URAIAN,
						kasd.DEBET AS DEBET,
						kasd.KREDIT AS KREDIT,
						kasd.NO_FKTR AS NO_PB
					FROM kas, kasd
					WHERE kas.NO_BUKTI = kasd.NO_BUKTI
					AND kas.PER='$per'
					AND kasd.NO_FKTR <> ''
				) AA ORDER BY TYP, NO_BUKTI");
		}

		// kembalikan filter2-an
		
		// $acno = Account::where('BNK','2')->get();
		// session()->put('filter_acno1', $request->ACNO);
		session()->put('filter_tglDari', $request->tglDr);
		session()->put('filter_tglSampai', $request->tglSmp);
		session()->put('filter_type', $request->TYPE);
		session()->put('filter_periode', $request->perio);
		
		if($request->has('filter'))
		{
			
			$per = Perid::query()->get();
			return view('freport_lihatpnpb.report')->with(['hasil' => $query])->with(['per' => $per]);
		}
		
		$data = [];
		foreach ($query as $key => $value) {
			array_push($data, array(
				'NO_BUKTI' => $query[$key]->NO_BUKTI,
				'TGL' => $query[$key]->TGL,
				'TYP' => $query[$key]->TYP,
				'DEBET' => $query[$key]->DEBET,
				'KREDIT' => $query[$key]->KREDIT,
				'ACNO' => $query[$key]->ACNO,
				'NACNO' => $query[$key]->NACNO,
				'URAIAN' => $query[$key]->URAIAN,
				'NO_PB' => $query[$key]->NO_PB
			));
		}

		array_push($data, array(
			'NO_BUKTI' => '',
			'TGL' => $tglSmpD,
			'AWAL' => $xawal1,
			'TYPE' => $type,
		));


		$PHPJasperXML->setData($data);
		ob_end_clean();
		$PHPJasperXML->outpage("I");
		
	}
	
	

	
}
