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

class RSaldoBankController extends Controller
{

   public function report()
    {
		$acno = Account::query()->get();
		$per = Perid::query()->get();
		session()->put('filter_periode', '');
		//return $acno;
        return view('freport_saldobank.report')->with(['acno' => $acno])->with(['per' => $per])->with(['hasil' => []]);
		
    }

    	public function jasperSaldoBankReport(Request $request) 
	{
		$file 	= '';
		$PHPJasperXML = new PHPJasperXML();
		$PHPJasperXML->load_xml_file(base_path().('/app/reportc01/phpjasperxml/'.$file.'.jrxml'));
		
		
        	if ($request->session()->has('periode')) 
		{
			$periode = $request->session()->get('periode')['bulan']. '/' . $request->session()->get('periode')['tahun'];
		} else
		{
			$periode = '';
		}
		
		if($request['perio'])
		{
			$periode = $request['perio'];
		}
		
		$bulan = substr($periode,0,2);
		$tahun = substr($periode,3,4);

		session()->put('filter_periode', $periode);
		
		$queryakum = DB::SELECT("SET @akum:=0;");
		$query = DB::SELECT("SELECT account.ACNO AS ACNO,
				SUM(accountd.AW01) AS AW01,
				SUM(accountd.AW02) AS AW02,
				SUM(accountd.AW03) AS AW03,
				SUM(accountd.AW04) AS AW04,
				SUM(accountd.AW05) AS AW05,
				SUM(accountd.AW06) AS AW06,
				SUM(accountd.AW07) AS AW07,
				SUM(accountd.AW08) AS AW08,
				SUM(accountd.AW09) AS AW09,
				SUM(accountd.AW10) AS AW10,
				SUM(accountd.AW11) AS AW11,
				SUM(accountd.AW12) AS AW12
			FROM account, accountd
			WHERE account.ACNO = accountd.ACNO
			AND accountd.YER = '$tahun'
			-- AND accountd.YER = 2021
			AND accountd.KEL = 110
			GROUP BY accountd.KEL = 110;
		");

		if($request->has('filter'))
		{
			$acno = Account::query()->get();
			$per = Perid::query()->get();
			return view('freport_saldobank.report')->with(['acno' => $acno])->with(['per' => $per])->with(['hasil' => $query]);
		}

		$data=[];
		foreach ($query as $key => $value)
		{
			array_push($data, array(
				'KODE' => $query[$key]->KODE,
				'NAMA' => $query[$key]->NAMA,
				'AWAL' => $query[$key]->JUM,
				'TGL_CETAK' => date("d/m/Y"),
			));
		}
		$PHPJasperXML->setData($data);
		ob_end_clean();
		$PHPJasperXML->outpage("I");
	}
	
	
}
