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

class RBankController extends Controller
{

    public function report()
    {
		$acno = Account::where('BNK','2')->get();
		session()->put('filter_tglDari', date("d-m-Y"));
		session()->put('filter_tglSampai', date("d-m-Y"));
		session()->put('filter_acno1', '');
		session()->put('filter_cair', '-');
		session()->put('filter_type', '-');
		session()->put('filter_nobukti1', '');
		session()->put('filter_nobukti2', 'ZZZ');
		session()->put('filter_pilih', '');

        return view('freport_bank.report')->with(['acno' => $acno])->with(['hasil' => []]);
    }
	 
	 
	public function jasperBankReport(Request $request) 
	{

		if (  $request->PILIH == '1' )
		{
			$file 	= 'Laporan_JurnalBank';
		} else if (  $request->PILIH == '2' )
		{
			$file 	= 'Laporan_RegisterBank';
		} else if (  $request->PILIH == '3' )
		{
			$file 	= 'Laporan_BankKeluarPendekPerBukti';
		} else if (  $request->PILIH == '4' )
		{
			$file 	= 'Laporan_BankPerNoBukti';
		} else
		{
			$file = '';
		}
		
	    // $file 	= 'bankn';
		$PHPJasperXML = new PHPJasperXML();
		$PHPJasperXML->load_xml_file(base_path() . ('/app/reportc01/phpjasperxml/' . $file . '.jrxml'));
		
		// Check Filter
		
		if (!empty($request->tglDr) && !empty($request->tglSmp))
		{
			$tglDrD = date("Y-m-d", strtotime($request->tglDr));
			$tglSmpD = date("Y-m-d", strtotime($request->tglSmp));
			$filtertgl = " AND BANK.TGL between '".$tglDrD."' and '".$tglSmpD."' ";
		}
		
		if ( $request->TYPE != '-' )
		{
			$filtertype = " and BANK.TYPE ='".$request->TYPE."' ";
		}
		
		if (!empty($request->ACNO))
		{
			$filteracno = " and BANK.BACNO ='".$request->ACNO."' ";
		}
		
		if (  $request->CAIR != '-' )
		{
			$filtercair = " and BANKD.CAIR ='".$request->CAIR."' ";
		}
		
		if (!empty($request->nobukti1) && !empty($request->nobukti2))
		{
			$nobukti1x = $request->nobukti1;
			$nobukti2x = $request->nobukti2;
			$filternobukti = " AND BANK.NO_BUKTI between '".$nobukti1x."' and '".$nobukti2x."'  ";
		}

		$queryakum = DB::SELECT("SET @akum:=0;");
		$query = DB::SELECT(

			"SELECT bank.NO_BUKTI,
					DATE_FORMAT(bank.TGL,'%d/%m/%Y') AS TGL,
					CONVERT(bank.TGL,DATE) AS TGLX,
					bank.BACNO,
					bank.BNAMA,
					bank.JUMLAH AS TOTAL,
					bankd.ACNO,
					bankd.NACNO,
					bankd.URAIAN,
					0 AS AWAL,
					bankd.DEBET,
					bankd.KREDIT,
					bankd.JUMLAH,
					IF(bank.TYPE='BBM',1,2) AS BARIS,
					bank.TYPE, 
					DATE_FORMAT(bankd.JTEMPO,'%d/%m/%Y') AS JTEMPO,
					IF(bankd.CAIR=1,'V','') AS CAIR,
					DATE_FORMAT(bankd.TGL_CAIR,'%d/%m/%Y') AS TGL_CAIR,
					bankd.BG
				FROM bank, bankd 
				WHERE bank.NO_BUKTI=bankd.NO_BUKTI $filtertgl	
				$filtertype $filteracno $filtercair $filternobukti "
		);
		
		
	    // kembalikan filter2-an
		
		$acno = Account::where('BNK','2')->get();
		session()->put('filter_acno1', $request->ACNO);
		session()->put('filter_tglDari', $request->tglDr);
		session()->put('filter_tglSampai', $request->tglSmp);
		session()->put('filter_cair', $request->CAIR);
		session()->put('filter_type', $request->TYPE);
		session()->put('filter_nobukti1', $request->nobukti1);
		session()->put('filter_nobukti2', $request->nobukti2);
		
		
		
		if($request->has('filter'))
		{
			return view('freport_bank.report')->with(['acno' => $acno])->with(['hasil' => $query]);
			
		}
		
		$data = [];
		foreach ($query as $key => $value) {
			array_push($data, array(
				'NO_BUKTI' => $query[$key]->NO_BUKTI,
				'TGL' => $query[$key]->TGL,
				'TGL1' => $tglDrD,
				'TGL2' => $tglSmpD,
				'JTEMPO' => $query[$key]->JTEMPO,
				'TGL_CAIR' => $query[$key]->TGL_CAIR,
				'BG' => $query[$key]->BG,
				'CAIR' => $query[$key]->CAIR,
				'MASUK' => $query[$key]->DEBET,
				'KELUAR' => $query[$key]->KREDIT,
				'DEBET' => $query[$key]->DEBET,
				'KREDIT' => $query[$key]->KREDIT,
				'BANKDEBET' => $query[$key]->DEBET,
				'BANKKREDIT' => $query[$key]->KREDIT,
				'JUMLAH' => $query[$key]->JUMLAH,
				'TOTAL' => $query[$key]->TOTAL,
				'ACNO' => $query[$key]->ACNO,
				'NACNO' => $query[$key]->NACNO,
				'URAIAN' => $query[$key]->URAIAN,
				'SALDO' => $query[$key]->SALDO
			));
		}

		array_push($data, array(
			'NO_BUKTI' => $nobukti2x,
			'TGL' => $tglSmpD,
			'AWAL' => $xawal1,
			'TYPE' => $type,
			'CAIR' => $cair,
			'no' => $nobukti1,
		));


		$PHPJasperXML->setData($data);
		ob_end_clean();
		$PHPJasperXML->outpage("I");
		
	}
	
	

	
}
