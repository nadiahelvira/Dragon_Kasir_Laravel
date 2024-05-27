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


class RRltahunController extends Controller
{

   public function report()
    {
		$acno = Account::query()->get();
		$per = Perid::query()->get();
		//return $acno;
        return view('freport_rltahun.report')->with(['acno' => $acno])->with(['per' => $per])->with(['hasil' => []]);
		
    }
	
		public function getRltahunReport(Request $request)
    {
		
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
		
        $query = DB::table('rl')
			->select('KODE','NAMA','JUM'.$bulan. ' as JUM', 'AK'.$bulan. ' as AK')->where('YER',$tahun)->get();
			
		//if ($request->ajax())
		//{
				//$query = $query->whereBetween('TGL', [$tglDrD, $tglSmp]);
			
			//return Datatables::of($query)->addIndexColumn()->make(true);
		//}
		return Datatables::of($query)->addIndexColumn()->make(true);
    }	  

    public function jasperRltahunReport(Request $request) 
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
		
		$month = substr($periode,0,2);
		$year = substr($periode,3,4);
		$tgl_cetak = date("Y-m-d", strtotime($request->tglDr));
		$tgl_cetak1 = date("Y-m-d", strtotime($request->tglSmp));
		$periode = $request->perio;


		// if ($this->session->userdata['rugilaba_rugilaba'] == 'rugilaba_rugilaba') {
		// 	$month = substr($this->session->userdata['periode'], 0, 2);
		// 	$year = substr($this->session->userdata['periode'], -4);
		// 	$this->session->set_userdata('rugilaba_rugilaba', 'tampil');
		// } else {
		// 	$month = $this->input->post('BULAN', true);
		// 	$year = $this->input->post('TAHUN', true);
		// }


		session()->put('filter_periode', $periode);
		
		$queryakum = DB::SELECT("SET @akum:=0;");
		
		$variablell = DB::select('CALL akt_rlner(?)', array($year));
		
		$query = DB::SELECT("
				SELECT rl.GOL AS GOL, 
						rl.KODE AS KODE, 
						rl.NAMA AS NAMA,
						'$tgl_cetak' AS TGL_CETAK, 
						0 AS `01`,
						rl.JUM01 AS JUM01,
						0 AS `02`,
						rl.JUM02 AS JUM02,
						0 AS `03`,
						rl.JUM03 AS JUM03,
						0 AS `04`,
						rl.JUM04 AS JUM04,
						0 AS `05`,
						rl.JUM05 AS JUM05,
						0 AS `06`,
						rl.JUM06 AS JUM06,
						0 AS `07`,
						rl.JUM07 AS JUM07,
						0 AS `08`,
						rl.JUM08 AS JUM08,
						0 AS `09`,
						rl.JUM09 AS JUM09,
						0 AS `10`,
						rl.JUM10 AS JUM10,
						0 AS `11`,
						rl.JUM11 AS JUM11,
						0 AS `12`,
						rl.JUM12 AS JUM12
					FROM rl 
					WHERE rl.YER='$year' 
					ORDER BY rl.GOL
		");

		if($request->has('filter'))
		{
			$acno = Account::query()->get();
			$per = Perid::query()->get();
			return view('freport_rltahun.report')->with(['acno' => $acno])->with(['per' => $per])->with(['hasil' => $query]);
		}

		$data=[];
		foreach ($query as $key => $value)
		{
			array_push($data, array(


			));
		}
		$PHPJasperXML->setData($data);
		ob_end_clean();
		$PHPJasperXML->outpage("I");
	}
	
}
