<?php

namespace App\Http\Controllers\FReport;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Models\FMaster\Account;
use App\Models\Master\Perid;

use Illuminate\Http\Request;
use DataTables;
use Auth;
use DB;

include_once base_path()."/vendor/simitgroup/phpjasperxml/version/1.1/PHPJasperXML.inc.php";
use PHPJasperXML;

use \koolreport\laravel\Friendship;
use \koolreport\bootstrap4\Theme;

class RCashflowController extends Controller
{
    public function report()
    {
		$per = Perid::query()->get();
		$acno = Account::orderBy('acno')->get();
		session()->put('filter_tglDari', date("d-m-Y"));
		session()->put('filter_tglSampai', date("d-m-Y"));
		session()->put('filter_acno1', '');
		session()->put('filter_acno2', '');
		session()->put('filter_nacc1', '');
		session()->put('filter_nacc2', '');
		session()->put('filter_periode', '');

        return view('freport_cashflow.report')->with(['per' => $per])->with(['hasil' => []]);
		
    }

	public function jasperCashflowReport(Request $request) 
	{
		$file 	= 'Laporan_CashFlow';
		$PHPJasperXML = new PHPJasperXML();
		$PHPJasperXML->load_xml_file(base_path().('/app/reportc01/phpjasperxml/'.$file.'.jrxml'));

			$tglDrD = date("Y-m-d", strtotime($request['tglDr']));
            $tglSmpD = date("Y-m-d", strtotime($request['tglSmp']));
			
			// Convert tanggal agar ambil start of day/end of day
			$tglDr = Carbon::parse($request->tglDr)->startOfDay();
            $tglSmp = Carbon::parse($request->tglSmp)->endOfDay();

			
        $periode = date("m/Y", strtotime($request['tglDr']));
		$bulan = date("m", strtotime($request['tglDr']));
		$tahun = date("Y", strtotime($request['tglDr']));
		$month = date("m", strtotime($request['tglDr']));
		$year = date("Y", strtotime($request['tglDr']));
		$acno = $request->acno1;
		$acno2 = $request->acno2;


		// if ($this->session->userdata['ratio'] == 'ratio') {
		// 	$month = substr($this->session->userdata['periode'], 0, 2);
		// 	$year = substr($this->session->userdata['periode'], -4);
		// 	$this->session->set_userdata('ratio', 'tampil');
		// } else {
		// 	$month = $this->input->post('BULAN', true);
		// 	$year = $this->input->post('TAHUN', true);
		// }

		// $year1 = $year - 1;
		
		$queryakum = DB::SELECT("SET @akum:=0 ;");
		
		$variablell = DB::select('CALL akt_cashflow(?)', array($year));
		
		$query = DB::SELECT("
					SELECT mutasi.GOL, 
							mutasi.NAMA AS NAMA,
							mutasi.HEADER AS HEADER,  JUM01 AS JUMNOW, `TYPE` as TYPES from mutasi 
					WHERE YER='$year'  AND mutasi.TYPE<>''
					ORDER BY GOL"
		);


		// kembalikan filter2-an

		session()->put('filter_tglDari', $request->tglDr);
		session()->put('filter_tglSampai', $request->tglSmp);
		session()->put('filter_periode', $request->perio);
		session()->put('filter_acno1', $request->acno1);
		session()->put('filter_acno2', $request->acno2);
		session()->put('filter_nacc1', $request->nacc1);
		session()->put('filter_nacc2', $request->nacc2);

		if($request->has('filter'))
		{
		$acno = Account::orderBy('acno')->get();

        return view('freport_cashflow.report')->with(['per' => $per])->with(['hasil' => $query]);
		}

		$data=[];
		foreach ($query as $key => $value)
		{

			// while ($row1 = mysqli_fetch_assoc($result1)) {			
				
			// 	$GOL1  =  $row1["GOL"];
			// 	$TYPE1  =  $row1["TYPES"];
				
			// 	$query2 = "SELECT JUM01 AS JUMLALU from mutasi 
			// 			WHERE YER='$year1'  AND mutasi.TYPE<>'' AND GOL ='$GOL1' AND `TYPE` ='$TYPE1'
			// 			ORDER BY GOL";
			// 	$result2 = mysqli_query($conn, $query2);
				

			array_push($data, array(

				'TAHUNLALU' => $year1,
				'TAHUNINI' => $year,			
				'HEADER' => $query[$key]->HEADER,
				'NAMA' => $query[$key]->NAMA,
				'JUMLALU' =>  $query[$key]->JUMLALU,
				'JUMNOW' =>  $query[$key]->JUMNOW
				
			));
		}
		$PHPJasperXML->setData($data);
		ob_end_clean();
		$PHPJasperXML->outpage("I");
	}

	
}