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

class RRatioController extends Controller
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

        return view('freport_ratio.report')->with(['per' => $per])->with(['hasil' => []]);
		
    }

	public function jasperRatioReport(Request $request) 
	{
		$file 	= 'Laporan_Ratio';
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
		
		$variablell = DB::select('CALL akt_ratio(?)', array($year));
		
		$query = DB::SELECT("
					SELECT TAHUNINI, TAHUNLALU, YER, GOL, KODE, NAMA, NAMAA, NAMAB, KOLOMA, KOLOMB, KODE1, KODE1X, KODE2, GRUP, ATS_LALU, 
							ATS_NOW, BWH_LALU, BWH_NOW, JUM_LALU, JUM_NOW FROM (
					SELECT a.TAHUNINI, a.TAHUNLALU, a.YER,
							a.GOL, a.KODE, a.NAMA, a.NAMAA, a.NAMAB, a.KOLOMA,
							a.KOLOMB, a.KODE1, a.KODE1X, a.KODE2, a.GRUP, 
							a.ATS_LALU, a.BWH_LALU, a.JUM_LALU, 
							b.ATS_NOW, b.BWH_NOW, b.JUM_NOW FROM
					(SELECT (CAST('$year' AS INT)) AS TAHUNINI,
							(CAST('$year' AS INT)-1) AS TAHUNLALU, YER,
							GOL AS GOL,
							KODE AS KODE,
							NAMA AS NAMA,
							NAMAA AS NAMAA,
							NAMAB AS NAMAB,
							KOLOMA AS KOLOMA,
							KOLOMB AS KOLOMB,
							KODE1 AS KODE1,
							KODE1X AS KODE1X,
							KODE2 AS KODE2,
							GRUP AS GRUP,
							ATS$month AS ATS_LALU,
							0 AS ATS_NOW,
							BWH$month AS BWH_LALU,
							0 AS BWH_NOW,
							JUM$month AS JUM_LALU,
							0 AS JUM_NOW
					FROM ratio WHERE YER=(CAST('$year' AS INT)-1) AND NAMA<>'' AND GRUP<>'') a
					LEFT JOIN
							(SELECT (CAST('$year' AS INT)) AS TAHUNINI,
							(CAST('$year' AS INT)-1) AS TAHUNLALU, YER,
							GOL AS GOL,
							KODE AS KODE,
							NAMA AS NAMA,
							NAMAA AS NAMAA,
							NAMAB AS NAMAB,
							KOLOMA AS KOLOMA,
							KOLOMB AS KOLOMB,
							KODE1 AS KODE1,
							KODE1X AS KODE1X,
							KODE2 AS KODE2,
							GRUP AS GRUP,
							0 AS ATS_LALU,
							ATS$month AS ATS_NOW,
							0 AS BWH_LALU,
							BWH$month AS BWH_NOW,
							0 AS JUM_LALU,
							JUM$month AS JUM_NOW
					FROM ratio WHERE YER='$year' AND NAMA<>'' AND GRUP<>'') b
					ON a.gol = b.gol
					) AS AA ORDER BY GOL"
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

        return view('freport_ratio.report')->with(['per' => $per])->with(['hasil' => $query]);
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
				
				'PERIODEAWAL' => $query[$key]->PERIODEAWAL,
				'PERIODEAKHIR' => $query[$key]->PERIODEAKHIR,
				'TGL_CETAK' => $query[$key]->TGL_CETAK,
				'TAHUNLALU' => $query[$key]->TAHUNLALU,
				'TAHUNINI' => $query[$key]->TAHUNINI,
				'GOL' => $query[$key]->GOL,
				'KODE' => $query[$key]->KODE,
				'NAMA' => $query[$key]->NAMA,
				'NAMAA' => $query[$key]->NAMAA,
				'NAMAB' => $query[$key]->NAMAB,
				'KOLOMA' => $query[$key]->KOLOMA,
				'KOLOMB' => $query[$key]->KOLOMB,
				'KODE1' => $query[$key]->KODE1,
				'KODE1X' => $query[$key]->KODE1X,
				'KODE2' => $query[$key]->KODE2,
				'ATS_LALU' => $query[$key]->ATS_LALU,
				'ATS_NOW' => $query[$key]->ATS_NOW,
				'BWH_LALU' => $query[$key]->BWH_LALU,
				'BWH_NOW' => $query[$key]->BWH_NOW,
				'JUM_LALU' => $query[$key]->JUM_LALU,
				'X' => $query[$key]->X,
				'JUM_NOW' => $query[$key]->JUM_NOW,
				'GRUP' => $query[$key]->GRUP,
			));
		}
		$PHPJasperXML->setData($data);
		ob_end_clean();
		$PHPJasperXML->outpage("I");
	}

	
}