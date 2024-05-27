<?php

namespace App\Http\Controllers\FReport;

use App\Http\Controllers\Controller;
use App\Models\FMaster\Account;;
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


class RMemoController extends Controller
{

	public function report()
	{
		$acno = Account::query()->get();
		session()->put('filter_tglDari', date("d-m-Y"));
		session()->put('filter_tglSampai', date("d-m-Y"));

		return view('freport_memo.report')->with(['acno' => $acno])->with(['hasil' => []]);
	}
	 
	 public function jasperMemoReport(Request $request) 
	{

		
		$file 	= 'memon';

		
		$PHPJasperXML = new PHPJasperXML();
		$PHPJasperXML->load_xml_file(base_path().('/app/reportc01/phpjasperxml/'.$file.'.jrxml'));
		
		$tglDrD = date("Y-m-d", strtotime($request->tglDr));
		$tglSmpD = date("Y-m-d", strtotime($request->tglSmp));
		//$acno = $request->acno;
		session()->put('filter_tglDari', $request->tglDr);
		session()->put('filter_tglSampai', $request->tglSmp);

		$query = DB::SELECT("
			SELECT memo.NO_BUKTI,memo.TGL,memod.DEBET,memod.KREDIT,memod.ACNO,memod.NACNO, memod.ACNOB,memod.NACNOB, memod.URAIAN
			FROM memo, memod 
			WHERE memo.NO_BUKTI=memod.NO_BUKTI  and memo.TGL between '$tglDrD' and '$tglSmpD' 
			ORDER BY memo.NO_BUKTI;
		");

		if($request->has('filter'))
		{
			$acno = Account::query()->get();
	
			return view('freport_memo.report')->with(['acno' => $acno])->with(['hasil' => $query]);
		}

		$data=[];
		foreach ($query as $key => $value)
		{
			array_push($data, array(
				'NO_BUKTI' => $query[$key]->NO_BUKTI,
				'TGL' => $query[$key]->TGL,
				'DEBET' => $query[$key]->DEBET,
				'KREDIT' => $query[$key]->KREDIT,
				'ACNO' => $query[$key]->ACNO,
				'NACNO' => $query[$key]->NACNO,
				'ACNOB' => $query[$key]->ACNOB,
				'NACNOB' => $query[$key]->NACNOB,
				'URAIAN' => $query[$key]->URAIAN,
			));
		}
		$PHPJasperXML->setData($data);
		ob_end_clean();
		$PHPJasperXML->outpage("I");
	}
	
}
