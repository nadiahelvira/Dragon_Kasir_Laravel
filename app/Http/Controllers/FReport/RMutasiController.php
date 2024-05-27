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


class RMutasiController extends Controller
{

	public function report()
	{
		$acno = Account::query()->get();
		session()->put('filter_bulan', '');
		session()->put('filter_tahun', '');

		return view('freport_mutasi.report')->with(['acno' => $acno])->with(['hasil' => []]);
	}
	 
	 public function jasperMutasiReport(Request $request) 
	{
		$file 	= 'Laporan_Mutasi';
		
		$PHPJasperXML = new PHPJasperXML();
		$PHPJasperXML->load_xml_file(base_path().('/app/reportc01/phpjasperxml/'.$file.'.jrxml'));

		// if ($this->session->userdata['mutasi'] == 'mutasi') {
		// 	$month = '01';
		// 	$year = '2001';
		// 	$this->session->set_userdata('mutasi', 'tampil');
		// } else {
		// 	$month = $this->input->post('BULAN', true);
		// 	$year = $this->input->post('TAHUN', true);
		// }

		$periode = date("m/Y", strtotime($request['tglDr']));
		$bulan = date("m", strtotime($request['tglDr']));
		$tahun = date("Y", strtotime($request['tglDr']));
		$month = date("m", strtotime($request['tglDr']));
		$year = date("Y", strtotime($request['tglDr']));
		$acno = $request->acno1;
		$acno2 = $request->acno2;

		$query = DB::SELECT("SELECT TGL_CETAK, GRUP, TINGKAT, ACNO, NAMA, JUMLAH FROM
		(
			SELECT DATE_FORMAT(NOW(),'%d/%m/%Y') AS TGL_CETAK,
						'SALDO AWAL' AS GRUP,
						1 AS TINGKAT,
						account.ACNO AS ACNO, 
						account.NAMA AS NAMA, 
						accountd.AW$month AS JUMLAH
				FROM account, accountd 
				WHERE account.ACNO = accountd.ACNO 
				AND accountd.YER='$year' 
				AND account.ACNO < '120'
				UNION ALL
				SELECT DATE_FORMAT(NOW(),'%d/%m/%Y') AS TGL_CETAK, 
					'PENDAPATAN' AS GRUP,
					2 AS TINGKAT,
					account.ACNO AS ACNO, 
					account.NAMA AS NAMA, 
					(accountd.KK$month+accountd.BK$month)-(accountd.KD$month+accountd.BD$month) AS JUMLAH
				FROM account, accountd 
				WHERE account.ACNO = accountd.ACNO 
				AND accountd.YER='$year' 
				AND account.ACNO >= '120' AND account.ACNO < '600' AND ((accountd.KK$month+accountd.BK$month)-(accountd.KD$month+accountd.BD$month))  > 0
				UNION ALL
				SELECT DATE_FORMAT(NOW(),'%d/%m/%Y') AS TGL_CETAK, 
					'PENDAPATAN A' AS GRUP,
					2 AS TINGKAT,
					'600' AS ACNO, 
					'Biaya Pemasaran' AS NAMA, 
					sum((accountd.KK$month+accountd.BK$month)-(accountd.KD$month+accountd.BD$month)) AS JUMLAH
				FROM account, accountd 
				WHERE account.ACNO = accountd.ACNO 
				AND accountd.YER='$year'
				AND account.ACNO >= '600' AND account.ACNO < '700' AND ((accountd.KK01+accountd.BK01)-(accountd.KD01+accountd.BD01))  > 0
				UNION ALL
				SELECT DATE_FORMAT(NOW(),'%d/%m/%Y') AS TGL_CETAK, 
					'PENDAPATAN B' AS GRUP,
					2 AS TINGKAT,
					'700' AS ACNO, 
					'Biaya Pabrik' AS NAMA, 
					sum((accountd.KK$month+accountd.BK$month)-(accountd.KD$month+accountd.BD$month)) AS JUMLAH
				FROM account, accountd 
				WHERE account.ACNO = accountd.ACNO  
				AND accountd.YER='$year'
				AND account.ACNO >= '700' AND account.ACNO < '800' AND ((accountd.KK$month+accountd.BK$month)-(accountd.KD$month+accountd.BD$month))  > 0
				UNION ALL
				SELECT DATE_FORMAT(NOW(),'%d/%m/%Y') AS TGL_CETAK, 
					'PENDAPATAN C' AS GRUP,
					2 AS TINGKAT,
					'800' AS ACNO, 
					'Biaya Umum dan Administrasi' AS NAMA, 
					sum((accountd.KK$month+accountd.BK$month)-(accountd.KD$month+accountd.BD$month)) AS JUMLAH
				FROM account, accountd 
				WHERE account.ACNO = accountd.ACNO 
				AND accountd.YER='$year' 
				AND account.ACNO >= '800' AND account.ACNO < '900' AND ((accountd.KK$month+accountd.BK$month)-(accountd.KD$month+accountd.BD$month))  > 0
				UNION ALL
				SELECT DATE_FORMAT(NOW(),'%d/%m/%Y') AS TGL_CETAK, 
					'PENDAPATAN D' AS GRUP,
					2 AS TINGKAT,
					'900' AS ACNO, 
					'Biaya Lain' AS NAMA, 
					sum((accountd.KK$month+accountd.BK$month)-(accountd.KD$month+accountd.BD$month)) AS JUMLAH
				FROM account, accountd 
				WHERE account.ACNO = accountd.ACNO 
				AND accountd.YER='$year' 
				AND account.ACNO >= '900' AND account.ACNO < '999' AND ((accountd.KK$month+accountd.BK$month)-(accountd.KD$month+accountd.BD$month))  > 0
				UNION ALL
				SELECT DATE_FORMAT(NOW(),'%d/%m/%Y') AS TGL_CETAK, 
					'PENGELUARAN' AS GRUP,
					3 AS TINGKAT,
					account.ACNO AS ACNO, 
					account.NAMA AS NAMA, 
					(accountd.KD$month+accountd.BD$month)-(accountd.KK$month+accountd.BK$month) AS JUMLAH
				FROM account, accountd 
				WHERE account.ACNO = accountd.ACNO 
				AND accountd.YER='$year' 
				AND account.ACNO >= '120' AND account.ACNO < '600' AND ((accountd.KD$month+accountd.BD$month)-(accountd.KK$month+accountd.BK$month))  > 0
				UNION ALL
				SELECT DATE_FORMAT(NOW(),'%d/%m/%Y') AS TGL_CETAK, 
					'PENGELUARAN A' AS GRUP,
					3 AS TINGKAT,
					'600' AS ACNO, 
					'Biaya Pemasaran' AS NAMA, 
					sum((accountd.KD$month+accountd.BD$month)-(accountd.KK$month+accountd.BK$month)) AS JUMLA
				FROM account, accountd 
				WHERE account.ACNO = accountd.ACNO 
				AND accountd.YER='$year'
				AND account.ACNO >= '600' AND account.ACNO < '700' AND ((accountd.KD$month+accountd.BD$month)-(accountd.KK$month+accountd.BK$month))  > 0
				UNION ALL
				SELECT DATE_FORMAT(NOW(),'%d/%m/%Y') AS TGL_CETAK, 
					'PENGELUARAN B' AS GRUP,
					3 AS TINGKAT,
					'700' AS ACNO, 
					'Biaya Pabrik' AS NAMA, 
					sum((accountd.KD$month+accountd.BD$month)-(accountd.KK$month+accountd.BK$month)) AS JUMLAH
				FROM account, accountd 
				WHERE account.ACNO = accountd.ACNO 
				AND accountd.YER='$year'
				AND account.ACNO >= '700' AND account.ACNO < '800' AND ((accountd.KD$month+accountd.BD$month)-(accountd.KK$month+accountd.BK$month))  > 0
				UNION ALL
				SELECT DATE_FORMAT(NOW(),'%d/%m/%Y') AS TGL_CETAK, 
					'PENGELUARAN C' AS GRUP,
					3 AS TINGKAT,
					'800' AS ACNO, 
					'Biaya Umum dan Administrasi' AS NAMA, 
					sum((accountd.KD$month+accountd.BD$month)-(accountd.KK$month+accountd.BK$month)) AS JUMLAH
				FROM account, accountd 
				WHERE account.ACNO = accountd.ACNO 
				AND accountd.YER='$year'
				AND account.ACNO >= '800' AND account.ACNO < '900' AND ((accountd.KD$month+accountd.BD$month)-(accountd.KK$month+accountd.BK$month))  > 0
				UNION ALL
				SELECT DATE_FORMAT(NOW(),'%d/%m/%Y') AS TGL_CETAK, 
					'PENGELUARAN D' AS GRUP,
					3 AS TINGKAT,
					'900' AS ACNO, 
					'Biaya Lain' AS NAMA, 
					sum((accountd.KD$month+accountd.BD$month)-(accountd.KK$month+accountd.BK$month)) AS JUMLAH
				FROM account, accountd 
				WHERE account.ACNO = accountd.ACNO 
				AND accountd.YER='$year'
				AND account.ACNO >= '900' AND account.ACNO < '999' AND ((accountd.KD$month+accountd.BD$month)-(accountd.KK$month+accountd.BK$month))  > 0
				UNION ALL
				SELECT DATE_FORMAT(NOW(),'%d/%m/%Y') AS TGL_CETAK, 
					'SALDO AKHIR' AS GRUP,
					4 AS TINGKAT,
					account.ACNO AS ACNO, 
					account.NAMA AS NAMA, 
					(accountd.AW$month + accountd.KD$month - accountd.KK$month + accountd.BD$month - accountd.BK$month ) AS JUMLAH
				FROM account, accountd 
				WHERE account.ACNO = accountd.ACNO 
				AND accountd.YER='$year'
				AND account.ACNO < '120'
			) AS AAAA
			ORDER BY TINGKAT, ACNO;
		");

		// kembalikan filter2-an
		
		session()->put('filter_bulan', $request->BULAN);
		session()->put('filter_tahun', $request->TAHUN);

		if($request->has('filter'))
		{
			$acno = Account::query()->get();
	
			return view('freport_mutasi.report')->with(['acno' => $acno])->with(['hasil' => $query]);
		}

		$data=[];
		foreach ($query as $key => $value)
		{
			array_push($data, array(
				'TGL_CETAK' => $query[$key]->TGL,
				'GRUP' => $query[$key]->GRUP,
				'TINGKAT' => $query[$key]->TINGKAT,
				'ACNO' => $query[$key]->ACNO,
				'NAMA' => $query[$key]->NAMA,
				'JUMLAH' => $query[$key]->JUMLAH,
			));
		}

		array_push($data, array(
			'BULAN' => $month,
			'TAHUN' => $year,
		));

		$PHPJasperXML->setData($data);
		ob_end_clean();
		$PHPJasperXML->outpage("I");
	}
	
}
