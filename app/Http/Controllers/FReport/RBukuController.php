<?php

namespace App\Http\Controllers\FReport;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Models\FMaster\Account;

use Illuminate\Http\Request;
use DataTables;
use Auth;
use DB;

include_once base_path()."/vendor/simitgroup/phpjasperxml/version/1.1/PHPJasperXML.inc.php";
use PHPJasperXML;

use \koolreport\laravel\Friendship;
use \koolreport\bootstrap4\Theme;

class RBukuController extends Controller
{
    public function report()
    {
		$acno = Account::orderBy('acno')->get();
		session()->put('filter_tglDari', date("d-m-Y"));
		session()->put('filter_tglSampai', date("d-m-Y"));
		session()->put('filter_acno1', '');
		session()->put('filter_acno2', '');
		session()->put('filter_nacc1', '');
		session()->put('filter_nacc2', '');

        return view('freport_buku.report')->with(['acno' => $acno])->with(['hasil' => []]);
		
    }

	public function jasperBukuReport(Request $request) 
	{
		$file 	= 'Laporan_BukuBesar';
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
		$acno_1 = $request->acno1;
		$acno_2 = $request->acno2;
		$tgl_cetak = date("Y-m-d", strtotime($request->tglDr));
		$tgl_cetak1 = date("Y-m-d", strtotime($request->tglSmp));

		session()->put('filter_tglDari', $request->tglDr);
		session()->put('filter_tglSampai', $request->tglSmp);
		session()->put('filter_acno1', $request->acno1);
		session()->put('filter_acno2', $request->acno2);
		session()->put('filter_nacc1', $request->nacc1);
		session()->put('filter_nacc2', $request->nacc2);
		
		$queryakum = DB::SELECT("SET @akum:=0 ;");
		$query = DB::SELECT("
		SELECT HERO.*,
								IF(
									@acno=HERO.BACNO,
									@saldo:=round(@saldo+HERO.AWAL+HERO.DEBET-HERO.KREDIT,2),
									@saldo:=round(HERO.AWAL+HERO.DEBET-HERO.KREDIT,2)
								) AS SALDO,
								@acno:=HERO.BACNO 
								FROM (
									SELECT accountd.ACNO AS BACNO, 
										accountd.NAMA AS BNAMA,
										'$tgl_cetak' AS TGL_CETAK,
										'SALDO AWAL' AS NO_BUKTI,
										-- DATE_FORMAT('$dateAW','%d/%m/%Y') AS TGL,
										'$dateAW' AS TGL,
										CONVERT('$dateAW',DATE) AS TGLX,
										'' AS ACNO,
										'' AS NACNO, 
										'' AS URAIAN, 
										accountd.AW$bulan AS AWAL, 
										0 AS DEBET,
										0 AS KREDIT,
										0 AS BARIS 
									FROM accountd 
									WHERE accountd.YER = '$tahun' 
									AND accountd.AW$bulan <> 0 
									AND accountd.ACNO >= '$acno_1'
									AND accountd.ACNO <= '$acno_2'
									UNION ALL 
									SELECT kas.BACNO AS BACNO,
										kas.BNAMA AS BNAMA,
										'$tgl_cetak' AS TGL_CETAK,
										kas.NO_BUKTI AS NO_BUKTI,
										-- kas.TGL AS TGL,
										DATE_FORMAT(kas.TGL,'%d/%m/%Y') AS TGL,
										CONVERT(KAS.TGL,date) as TGLX,
										kasd.ACNO AS ACNO,
										kasd.NACNO AS NACNO,
										kasd.URAIAN AS URAIAN,
										0 AS AWAL,
										kasd.DEBET AS DEBET,
										kasd.KREDIT AS KREDIT,
										IF(kas.TYPE='BKM',1,3) AS BARIS 
									FROM kas, kasd 
									WHERE kas.NO_BUKTI = kasd.NO_BUKTI 
									AND kas.PER = '$periode' 
									AND kas.BACNO >= '$acno_1'
									AND kas.BACNO <= '$acno_2'
									UNION ALL 
									SELECT kasd.ACNO AS BACNO,
										kasd.NACNO AS BNAMA,
										'$tgl_cetak' AS TGL_CETAK,
										kas.NO_BUKTI AS NO_BUKTI,
										-- kas.TGL AS TGL,
										DATE_FORMAT(kas.TGL,'%d/%m/%Y') AS TGL,
										CONVERT(kas.TGL,date) AS TGLX,
										kas.BACNO AS ACNO,
										kas.BNAMA AS NACNO,
										kasd.URAIAN AS URAIAN,
										0 AS AWAL,
										kasd.KREDIT AS DEBET,
										kasd.DEBET AS KREDIT,
										IF(kas.TYPE = 'BKM',3,1) AS BARIS 
									FROM kas,kasd 
									WHERE kas.NO_BUKTI = kasd.NO_BUKTI 
									AND kas.PER = '$periode' 
									AND kasd.ACNO >= '$acno_1'
									AND kasd.ACNO <= '$acno_2'
									UNION ALL  
									SELECT bank.BACNO AS BACNO,
										bank.BNAMA AS BNAMA,
										'$tgl_cetak' AS TGL_CETAK,
										bank.NO_BUKTI AS NO_BUKTI,
										-- bank.TGL AS TGL,
										DATE_FORMAT(bank.TGL,'%d/%m/%Y') AS TGL,
										CONVERT(bank.TGL,DATE) AS TGLX,
										bankd.ACNO AS ACNO,
										bankd.NACNO AS NACNO,
										bankd.URAIAN ASURAIAN,
										0 AS AWAL,
										bankd.DEBET AS DEBET,
										bankd.KREDIT AS KREDIT,
										IF(bank.TYPE='BBM',2,4) AS BARIS 
									FROM bank, bankd 
									WHERE bank.NO_BUKTI = bankd.NO_BUKTI 
									AND bank.PER = '$periode' 
									AND bank.BACNO >= '$acno_1'
									AND bank.BACNO <= '$acno_2'
									UNION ALL 
									SELECT bankd.ACNO AS BACNO,
										bankd.NACNO AS BNAMA, 
										'$tgl_cetak' AS TGL_CETAK,
										bank.NO_BUKTI AS NO_BUKTI, 
										-- bank.TGL AS TGL,
										DATE_FORMAT(bank.TGL,'%d/%m/%Y') AS TGL,
										CONVERT(bank.TGL,DATE) AS TGLX, 
										bank.BACNO AS ACNO, 
										bank.BNAMA AS NACNO, 
										bankd.URAIAN AS URAIAN,
										0 AS AWAL, 
										bankd.KREDIT AS DEBET, 
										bankd.DEBET AS KREDIT, 
										IF(bank.TYPE='BBM',4,2) AS BARIS 
									FROM bank, bankd 
									WHERE bank.NO_BUKTI = bankd.NO_BUKTI 
									AND  bank.PER = '$periode' 
									AND bankd.ACNO >= '$acno_1'
									AND bankd.ACNO <= '$acno_2'
									UNION ALL 
									SELECT memod.ACNO AS BACNO,
										memod.NACNO AS BNAMA,
										'$tgl_cetak' AS TGL_CETAK,
										memo.NO_BUKTI AS NO_BUKTI,
										-- memo.TGL AS TGL,
										DATE_FORMAT(memo.TGL,'%d/%m/%Y') AS TGL,
										CONVERT(memo.TGL,date) AS TGLX, 
										'' AS ACNO, 
										'' AS NACNO, 
										memod.URAIAN AS URAIAN,
										0 AS AWAL, 
										memod.DEBET AS DEBET, 
										memod.KREDIT AS KREDIT,
										5 AS BARIS
									FROM memo, memod  
									WHERE memo.NO_BUKTI = memod.NO_BUKTI 
									AND memod.ACNO >= '$acno_1'
									AND memod.ACNO <= '$acno_2'
									AND memo.PER = '$periode' 
								) HERO JOIN (SELECT @saldo:=0,@ACNO:='' ) SX ON 1=1 
								ORDER BY HERO.BACNO, HERO.TGLX, HERO.BARIS, HERO.NO_BUKTI"
		);

		if($request->has('filter'))
		{
		$acno = Account::orderBy('acno')->get();

        return view('freport_buku.report')->with(['acno' => $acno])->with(['hasil' => $query]);
		}

		$data=[];
		foreach ($query as $key => $value)
		{
			array_push($data, array(
				'NO_BUKTI' => $query[$key]->NO_BUKTI,
				'TGL' => $query[$key]->TGL,
				'BACNO' => $query[$key]->BACNO,
				'BNAMA' => $query[$key]->BNAMA,
				'ACNO' => $query[$key]->ACNO,
				'NACNO' => $query[$key]->NACNO,
				'URAIAN' => $query[$key]->URAIAN,
				'AWAL' => $query[$key]->AWAL,
				'DEBET' => $query[$key]->DEBET,
				'KREDIT' => $query[$key]->KREDIT,
				'SALDO' => $query[$key]->SALDO,
			));
		}
		$PHPJasperXML->setData($data);
		ob_end_clean();
		$PHPJasperXML->outpage("I");
	}

	
}