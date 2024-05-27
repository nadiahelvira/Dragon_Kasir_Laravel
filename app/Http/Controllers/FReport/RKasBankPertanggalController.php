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

class RKasBankPertanggalController extends Controller
{

    public function report()
    {
		// $acno = Account::where('BNK', '2')->get();
		session()->put('filter_tglDari', date("d-m-Y"));
		session()->put('filter_tglSampai', date("d-m-Y"));
		// session()->put('filter_acno1', '');

        return view('freport_kasbankpertanggal.report')->with(['hasil' => []]);
    }
	 
	 
	public function jasperKasBankPertanggalReport(Request $request) 
	{
	    $file 	= 'Laporan_KasBankPerTanggal';
		$PHPJasperXML = new PHPJasperXML();
		$PHPJasperXML->load_xml_file(base_path() . ('/app/reportc01/phpjasperxml/' . $file . '.jrxml'));

		// Check Filter

		$tglDrD = date("Y-m-d", strtotime($request->tglDr));
		$tglSmpD = date("Y-m-d", strtotime($request->tglSmp));
		$periode = date("m/Y", strtotime($request['tglDr']));
		$bulan = date("m", strtotime($request['tglDr']));
		$tahun = date("Y", strtotime($request['tglDr']));
		$acno = $request->acno;

		$queryakum = DB::SELECT("SET @akum:=0;");
		$query = DB::SELECT(
		"SELECT NO_BUKTI, `TYPE`, URAIAN, ACNO, TGL, KASDEBET, KASKREDIT, BANKDEBET, BANKKREDIT, SALDOAWAL, SALDOAKHIR FROM
			( SELECT bank.NO_BUKTI AS NO_BUKTI,
					bank.TYPE AS `TYPE`,
					bankd.URAIAN AS URAIAN,
					bankd.ACNO AS ACNO,
					-- bank.TGL AS TGL,
					DATE_FORMAT(bank.TGL,'%d/%m/%Y') AS TGL,
					0 AS KASDEBET,
					0 AS KASKREDIT,
					bankd.DEBET AS BANKDEBET,
					bankd.KREDIT AS BANKKREDIT,
					0 AS SALDOAWAL,
					0 AS SALDOAKHIR
				FROM bank, bankd
				WHERE bank.NO_BUKTI = bankd.NO_BUKTI
				-- AND bank.PER='$bulan'
				AND bank.TGL BETWEEN '$tglDrD' AND '$tglSmpD'
				UNION ALL
				SELECT kas.NO_BUKTI AS NO_BUKTI,
					kas.TYPE AS `TYPE`,
					kasd.URAIAN AS URAIAN,
					kasd.ACNO AS ACNO,
					-- kas.TGL AS TGL,
					DATE_FORMAT(kas.TGL,'%d/%m/%Y') AS TGL,
					kasd.DEBET AS KASDEBET,
					kasd.KREDIT AS KASKREDIT,
					0 AS BANKDEBET,
					0 AS BANKKREDIT,
					0 AS SALDOAWAL,
					0 AS SALDOAKHIR
				FROM kas, kasd
				WHERE kas.NO_BUKTI = kasd.NO_BUKTI
				-- AND kas.PER='$bulan'
				AND kas.TGL BETWEEN '$tglDrD' AND '$tglSmpD'
		) AA ORDER BY `TYPE` DESC, NO_BUKTI"
		);

		// kembalikan filter2-an
		
		// $acno = Account::where('BNK','2')->get();
		// session()->put('filter_acno1', $request->ACNO);
		session()->put('filter_tglDari', $request->tglDr);
		session()->put('filter_tglSampai', $request->tglSmp);
		
		if($request->has('filter'))
		{
			return view('freport_kasbankpertanggal.report')->with(['hasil' => $query]);
		}
		
		$data = [];
		foreach ($query as $key => $value) {
			array_push($data, array(
				'NO_BUKTI' => $query[$key]->NO_BUKTI,
				'TGL' => $query[$key]->TGL,
				'DEBET' => $query[$key]->DEBET,
				'KREDIT' => $query[$key]->KREDIT,
				'BANKDEBET' => $query[$key]->BANKDEBET,
				'BANKKREDIT' => $query[$key]->BANKKREDIT,
				'KASDEBET' => $query[$key]->KASDEBET,
				'KASKREDIT' => $query[$key]->KASKREDIT,
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
