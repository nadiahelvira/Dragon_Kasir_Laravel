<?php

namespace App\Http\Controllers\FReport;

use App\Http\Controllers\Controller;
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

class RBiayaController extends Controller
{
	
	public function report()
	{
		$per = Perid::query()->get();
		session()->put('filter_tglDari', date("d-m-Y"));
		session()->put('filter_tglSampai', date("d-m-Y"));
		session()->put('filter_biaya', '');

		return view('freport_biaya.report')->with(['per' => $per])->with(['hasil' => []]);
	}

	public function jasperBiayaReport(Request $request)
	{

		$file 	= 'Laporan_Biaya';
		$PHPJasperXML = new PHPJasperXML();
		$PHPJasperXML->load_xml_file(base_path() . ('/app/reportc01/phpjasperxml/' . $file . '.jrxml'));
		
		// Check Filter
		
		if (!empty($request->perio))
		{
			$filter_per = " AND account.per='".$request->perio."' ";
		}

		$bulan = substr($periode,0,2);
		$tahun = substr($periode,3,4);
		$tgl_1 = date("Y-m-d", strtotime($request->tglDr));
		$tgl_cetak1 = date("Y-m-d", strtotime($request->tglSmp));
		$periode = $request->perio;
		$acno = $request->acno;


		if ($this->session->userdata['biaya'] == 'biaya') {
			// $bulanini = '02';
			// $tahunini = '2021';
			$bulanini = substr($this->session->userdata['periode'], 0, 2);
			$tahunini = substr($this->session->userdata['periode'], -4);
			$year = ((int)$bulanini - 1);
			// $bulanlalu = $bulanini . '-01';
			$bulanlalu = '00';
			$acno = '6';
			$this->session->set_userdata('biaya', 'tampil');
		} else {
			$bulanini = $request->bulan;
			$tahunini = $request->tahun;
			// $bulanini = $this->input->post('BULAN', true);
			// $tahunini = $this->input->post('TAHUN', true);
			// $acno = $this->input->post('ACNO', true);
			$acno =  $request->acno;
			if ($bulanini == '01') {
				$bulanlalu = '00';
				$tahunini = $tahunini;
			} elseif ($bulanini == '02') {
				$bulanlalu = '01';
				$tahunini = $tahunini;
			} elseif ($bulanini == '03') {
				$bulanlalu = '02';
				$tahunini = $tahunini;
			} elseif ($bulanini == '04') {
				$bulanlalu = '03';
				$tahunini = $tahunini;
			} elseif ($bulanini == '05') {
				$bulanlalu = '04';
				$tahunini = $tahunini;
			} elseif ($bulanini == '06') {
				$bulanlalu = '05';
				$tahunini = $tahunini;
			} elseif ($bulanini == '07') {
				$bulanlalu = '06';
				$tahunini = $tahunini;
			} elseif ($bulanini == '08') {
				$bulanlalu = '07';
				$tahunini = $tahunini;
			} elseif ($bulanini == '09') {
				$bulanlalu = '08';
				$tahunini = $tahunini;
			} elseif ($bulanini == '10') {
				$bulanlalu = '09';
				$tahunini = $tahunini;
			} elseif ($bulanini == '11') {
				$bulanlalu = '10';
				$tahunini = $tahunini;
			} elseif ($bulanini == '12') {
				$bulanlalu = '11';
				$tahunini = substr($this->session->userdata['periode'], -4);
			} else {
				$bulanlalu = '12';
				$tahunini = substr($this->session->userdata['periode'], -4);
			}
		}

		$queryakum = DB::SELECT("SET @akum:=0;");
		$query = DB::SELECT(
		"SELECT account.ACNO,
				account.NAMA,
				account.KEL,
				'$acno' AS KODE,
				(accountd.KD$bulanini-accountd.KK$bulanini+accountd.BD$bulanini-accountd.BK$bulanini+accountd.MD$bulanini-accountd.MK$bulanini) AS BULANINI,
				(accountd.KD$bulanlalu-accountd.KK$bulanlalu+accountd.BD$bulanlalu-accountd.BK$bulanlalu+accountd.MD$bulanlalu-accountd.MK$bulanlalu) AS BULANLALU,
				accountd.AK$bulanini AS SDBULANINI,
				(accountd.AK$bulanini/$bulanini) AS RATAPERBULAN
			FROM account, accountd
			WHERE account.ACNO=accountd.ACNO
			AND accountd.YER='$tahunini' 
			-- AND LEFT(account.ACNO, 1) = '$acno'
			ORDER BY account.KEL, account.ACNO"
		);

		// kembalikan filter2-an
	
		session()->put('filter_tglDari', $request->tglDr);
		session()->put('filter_tglSampai', $request->tglSmp);
		session()->put('filter_biaya', $request->acno);
		session()->put('filter_nobukti1', $request->nobukti1);
		session()->put('filter_nobukti2', $request->nobukti2);

		if($request->has('filter'))
		{
			return view('freport_biaya.report')->with(['per' => $per])->with(['hasil' => $query]);
		}
		
		$data = [];
		foreach ($query as $key => $value) {
			array_push($data, array(

				'ACNO' => $query[$key]->ACNO,
				'NAMA' => $query[$key]->NAMA,
				'KEL' => $query[$key]->KEL,
				'KODE' => $query[$key]->KODE,
				// 'TGL' => $query[$key]->TGL,
				'BULANINI' => $query[$key]->BULANINI,
				'BULANLALU' => $query[$key]->BULANLALU,
				'SDBULANINI' => $query[$key]->SDBULANINI,
				'RATAPERBULAN' => $query[$key]->RATAPERBULAN,
			));
		}


		$PHPJasperXML->setData($data);
		ob_end_clean();
		$PHPJasperXML->outpage("I");
	}
}
