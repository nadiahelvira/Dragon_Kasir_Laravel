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


class RRlController extends Controller
{

   public function report()
    {
		$acno = Account::query()->get();
		$per = Perid::query()->get();
		session()->put('filter_pilih', '');
		//return $acno;
        return view('freport_rl.report')->with(['acno' => $acno])->with(['per' => $per])->with(['hasil' => []]);
		
    }
	
		public function getRlReport(Request $request)
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

    public function jasperRlReport(Request $request) 
	{
		$file 	= 'Laporan_RugiLaba_RugiLababaruAkumulasi';

		if (  $request->PILIH == '1' )
		{
			$file 	= 'Laporan_RugiLaba_RugiLababaruBerjalan';
		} else if (  $request->PILIH == '2' )
		{
			$file 	= 'Laporan_RugiLaba_RugiLababaruAkumulasi';
		} else
		{
			$file = '';
		}
		
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
		$pilih = $request->PILIH;


		// if ($this->session->userdata['rugilaba_rugilaba'] == 'rugilaba_rugilaba') {
		// 	$month = substr($this->session->userdata['periode'], 0, 2);
		// 	$year = substr($this->session->userdata['periode'], -4);
		// 	$this->session->set_userdata('rugilaba_rugilaba', 'tampil');
		// } else {
		// 	$month = $this->input->post('BULAN', true);
		// 	$year = $this->input->post('TAHUN', true);
		// }
		///	TANGGAL AWAL - AKHIR
		$periodeawal = '01' . '-' . '01' . '-' . $year;
		if ($month == '00') {
			$periodeakhir = '01' . '-' . $month . '-' . $year;
		} else if ($month == '01') {
			$periodeakhir = '31' . '-' . $month . '-' . $year;
		} else if ($month == '02') {
			$periodeakhir = '28' . '-' . $month . '-' . $year;
		} else if ($month == '03') {
			$periodeakhir = '31' . '-' . $month . '-' . $year;
		} else if ($month == '04') {
			$periodeakhir = '30' . '-' . $month . '-' . $year;
		} else if ($month == '05') {
			$periodeakhir = '31' . '-' . $month . '-' . $year;
		} else if ($month == '06') {
			$periodeakhir = '30' . '-' . $month . '-' . $year;
		} else if ($month == '07') {
			$periodeakhir = '31' . '-' . $month . '-' . $year;
		} else if ($month == '08') {
			$periodeakhir = '31' . '-' . $month . '-' . $year;
		} else if ($month == '09') {
			$periodeakhir = '30' . '-' . $month . '-' . $year;
		} else if ($month == '10') {
			$periodeakhir = '31' . '-' . $month . '-' . $year;
		} else if ($month == '11') {
			$periodeakhir = '30' . '-' . $month . '-' . $year;
		} else if ($month == '12') {
			$periodeakhir = '31' . '-' . $month . '-' . $year;
		} else {
			$periodeakhir = '31' . '-' . $month . '-' . $year;
		}

		session()->put('filter_periode', $periode);
		session()->put('filter_pilih', $request->PILIH);
		
		$queryakum = DB::SELECT("SET @akum:=0;");

		$variablell = DB::select('CALL akt_rlner(?)', array($year));

		$query2 = DB::SELECT(

		"SELECT NAMA, JUM$month AS JUM, AK$month AS AK FROM rl WHERE YER='$year' ORDER BY GOL"
		);
		
		if($request->has('filter'))
		{
			$acno = Account::query()->get();
			$per = Perid::query()->get();
			return view('freport_rl.report')->with(['per' => $per])->with(['hasil' => $query2]);
		}
		
		if ($pilih == '1') {
			$query = DB::SELECT(
				"SELECT (SELECT JUM$month FROM rl WHERE GOL=500 AND YER='$year') AS HASILPENJUALAN,
				(SELECT JUM$month FROM rl WHERE GOL=510 AND YER='$year') AS RETURPENJUALAN,
				(SELECT JUM$month FROM rl WHERE GOL=520 AND YER='$year') AS POTONGANPENJUALAN,
				(SELECT JUM$month FROM rl WHERE GOL=530 AND YER='$year') AS BONUSPENJUALAN,
				(SELECT JUM$month FROM rl WHERE GOL=5301 AND YER='$year') AS JUMLAH,
				(SELECT JUM$month FROM rl WHERE GOL=5305 AND YER='$year') AS PENJUALANBERSIH,
				(SELECT JUM$month FROM rl WHERE GOL=540 AND YER='$year') AS HARGAPOKOKPENJUALAN,
				(SELECT JUM$month FROM rl WHERE GOL=5401 AND YER='$year') AS LABAKOTOR,
				(SELECT JUM$month FROM rl WHERE GOL=600 AND YER='$year') AS BIAYAPEGAWAIPEMASARAN,
				(SELECT JUM$month FROM rl WHERE GOL=610 AND YER='$year') AS BIAYAPERJALANAN,
				(SELECT JUM$month FROM rl WHERE GOL=620 AND YER='$year') AS BIAYASOPIR,
				(SELECT JUM$month FROM rl WHERE GOL=630 AND YER='$year') AS BIAYAPROMOSIIKLAN,
				(SELECT JUM$month FROM rl WHERE GOL=640 AND YER='$year') AS BIAYAPENJUALAN,
				(SELECT JUM$month FROM rl WHERE GOL=650 AND YER='$year') AS BIAYAPOSTEL,
				(SELECT JUM$month FROM rl WHERE GOL=660 AND YER='$year') AS BIAYAGUDANGJADI,
				(SELECT JUM$month FROM rl WHERE GOL=670 AND YER='$year') AS BIAYAPEMELIHARAANJENDARAAN,
				(SELECT JUM$month FROM rl WHERE GOL=680 AND YER='$year') AS BIAYAPENYUSUTANKENDARAAN,
				(SELECT JUM$month FROM rl WHERE GOL=7001 AND YER='$year') AS JUMLAHBIAYAOPERASIONAL,
				(SELECT JUM$month FROM rl WHERE GOL=7002 AND YER='$year') AS LABAOPERASIONAL,
				(SELECT JUM$month FROM rl WHERE GOL=800 AND YER='$year') AS BIAYADIREKSIPEGAWAI,
				(SELECT JUM$month FROM rl WHERE GOL=810 AND YER='$year') AS BIAYAPERJALANAN2,
				(SELECT JUM$month FROM rl WHERE GOL=820 AND YER='$year') AS BIAYAKANTOR,
				(SELECT JUM$month FROM rl WHERE GOL=830 AND YER='$year') AS BIAYAPAMPLNASURANSI,
				(SELECT JUM$month FROM rl WHERE GOL=840 AND YER='$year') AS BIAYABANK,
				(SELECT JUM$month FROM rl WHERE GOL=850 AND YER='$year') AS PAJAKPEMDAASTEK,
				(SELECT JUM$month FROM rl WHERE GOL=860 AND YER='$year') AS BIAYAPEMELIHARAANAKTIVA,
				(SELECT JUM$month FROM rl WHERE GOL=870 AND YER='$year') AS BIAYAPENYUSUTANAKTIVA,
				(SELECT JUM$month FROM rl WHERE GOL=8701 AND YER='$year') AS JUMLAHBIAYAUMUM,
				(SELECT JUM$month FROM rl WHERE GOL=8702 AND YER='$year') AS LABARUGIUSAHA,
				(SELECT JUM$month FROM rl WHERE GOL=910 AND YER='$year') AS BEDAKAS,
				(SELECT JUM$month FROM rl WHERE GOL=920 AND YER='$year') AS KURANGLEBIHBAYAR,
				(SELECT JUM$month FROM rl WHERE GOL=930 AND YER='$year') AS SELISIHKURS,
				(SELECT JUM$month FROM rl WHERE GOL=940 AND YER='$year') AS PENDAPATANJASAGIRO,
				(SELECT JUM$month FROM rl WHERE GOL=950 AND YER='$year') AS PENDAPATANBUNGADEPOSIT,
				(SELECT JUM$month FROM rl WHERE GOL=960 AND YER='$year') AS PENDAPATANPENJUALANAKTIVA,
				(SELECT JUM$month FROM rl WHERE GOL=970 AND YER='$year') AS PENDAPATANSEWA,
				(SELECT JUM$month FROM rl WHERE GOL=980 AND YER='$year') AS PENDAPATANKERUGIANASURANSI,
				(SELECT JUM$month FROM rl WHERE GOL=990 AND YER='$year') AS PENDAPATANSAMPLE,
				(SELECT JUM$month FROM rl WHERE GOL=991 AND YER='$year') AS LAINLAIN,
				(SELECT JUM$month FROM rl WHERE GOL=992 AND YER='$year') AS JUMLAHPENDAPATANKERUGIAN,
				(SELECT JUM$month FROM rl WHERE GOL=993 AND YER='$year') AS LABARUGIBERSIHSEBELUMPAJAK,
				'$periodeawal' AS PERIODEAWAL,
				'$periodeakhir' AS PERIODEAKHIR
			FROM rl WHERE YER='$year'");
		} else if ($pilih == '2') {
			$query = DB::SELECT(
				"SELECT (SELECT AK$month FROM rl WHERE GOL=500 AND YER='$year') AS HASILPENJUALAN,
				(SELECT AK$month FROM rl WHERE GOL=510 AND YER='$year') AS RETURPENJUALAN,
				(SELECT AK$month FROM rl WHERE GOL=520 AND YER='$year') AS POTONGANPENJUALAN,
				(SELECT AK$month FROM rl WHERE GOL=530 AND YER='$year') AS BONUSPENJUALAN,
				(SELECT AK$month FROM rl WHERE GOL=5301 AND YER='$year') AS JUMLAH,
				(SELECT AK$month FROM rl WHERE GOL=5305 AND YER='$year') AS PENJUALANBERSIH,
				(SELECT AK$month FROM rl WHERE GOL=540 AND YER='$year') AS HARGAPOKOKPENJUALAN,
				(SELECT AK$month FROM rl WHERE GOL=5401 AND YER='$year') AS LABAKOTOR,
				(SELECT AK$month FROM rl WHERE GOL=600 AND YER='$year') AS BIAYAPEGAWAIPEMASARAN,
				(SELECT AK$month FROM rl WHERE GOL=610 AND YER='$year') AS BIAYAPERJALANAN,
				(SELECT AK$month FROM rl WHERE GOL=620 AND YER='$year') AS BIAYASOPIR,
				(SELECT AK$month FROM rl WHERE GOL=630 AND YER='$year') AS BIAYAPROMOSIIKLAN,
				(SELECT AK$month FROM rl WHERE GOL=640 AND YER='$year') AS BIAYAPENJUALAN,
				(SELECT AK$month FROM rl WHERE GOL=650 AND YER='$year') AS BIAYAPOSTEL,
				(SELECT AK$month FROM rl WHERE GOL=660 AND YER='$year') AS BIAYAGUDANGJADI,
				(SELECT AK$month FROM rl WHERE GOL=670 AND YER='$year') AS BIAYAPEMELIHARAANJENDARAAN,
				(SELECT AK$month FROM rl WHERE GOL=680 AND YER='$year') AS BIAYAPENYUSUTANKENDARAAN,
				(SELECT AK$month FROM rl WHERE GOL=7001 AND YER='$year') AS JUMLAHBIAYAOPERASIONAL,
				(SELECT AK$month FROM rl WHERE GOL=7002 AND YER='$year') AS LABAOPERASIONAL,
				(SELECT AK$month FROM rl WHERE GOL=800 AND YER='$year') AS BIAYADIREKSIPEGAWAI,
				(SELECT AK$month FROM rl WHERE GOL=810 AND YER='$year') AS BIAYAPERJALANAN2,
				(SELECT AK$month FROM rl WHERE GOL=820 AND YER='$year') AS BIAYAKANTOR,
				(SELECT AK$month FROM rl WHERE GOL=830 AND YER='$year') AS BIAYAPAMPLNASURANSI,
				(SELECT AK$month FROM rl WHERE GOL=840 AND YER='$year') AS BIAYABANK,
				(SELECT AK$month FROM rl WHERE GOL=850 AND YER='$year') AS PAJAKPEMDAASTEK,
				(SELECT AK$month FROM rl WHERE GOL=860 AND YER='$year') AS BIAYAPEMELIHARAANAKTIVA,
				(SELECT AK$month FROM rl WHERE GOL=870 AND YER='$year') AS BIAYAPENYUSUTANAKTIVA,
				(SELECT AK$month FROM rl WHERE GOL=8701 AND YER='$year') AS JUMLAHBIAYAUMUM,
				(SELECT AK$month FROM rl WHERE GOL=8702 AND YER='$year') AS LABARUGIUSAHA,
				(SELECT AK$month FROM rl WHERE GOL=910 AND YER='$year') AS BEDAKAS,
				(SELECT AK$month FROM rl WHERE GOL=920 AND YER='$year') AS KURANGLEBIHBAYAR,
				(SELECT AK$month FROM rl WHERE GOL=930 AND YER='$year') AS SELISIHKURS,
				(SELECT AK$month FROM rl WHERE GOL=940 AND YER='$year') AS PENDAPATANJASAGIRO,
				(SELECT AK$month FROM rl WHERE GOL=950 AND YER='$year') AS PENDAPATANBUNGADEPOSIT,
				(SELECT AK$month FROM rl WHERE GOL=960 AND YER='$year') AS PENDAPATANPENJUALANAKTIVA,
				(SELECT AK$month FROM rl WHERE GOL=970 AND YER='$year') AS PENDAPATANSEWA,
				(SELECT AK$month FROM rl WHERE GOL=980 AND YER='$year') AS PENDAPATANKERUGIANASURANSI,
				(SELECT AK$month FROM rl WHERE GOL=990 AND YER='$year') AS PENDAPATANSAMPLE,
				(SELECT AK$month FROM rl WHERE GOL=991 AND YER='$year') AS LAINLAIN,
				(SELECT AK$month FROM rl WHERE GOL=992 AND YER='$year') AS JUMLAHPENDAPATANKERUGIAN,
				(SELECT AK$month FROM rl WHERE GOL=993 AND YER='$year') AS LABARUGIBERSIHSEBELUMPAJAK,
				'$periodeawal' AS PERIODEAWAL,
				'$periodeakhir' AS PERIODEAKHIR
			FROM rl WHERE YER='$year'");
		}
		

		$data=[];
		foreach ($query as $key => $value)
		{
			array_push($data, array(

				'HASILPENJUALAN' => $query[$key]->HASILPENJUALAN,
				'RETURPENJUALAN' => $query[$key]->RETURPENJUALAN,
				'POTONGANPENJUALAN' => $query[$key]->POTONGANPENJUALAN,
				'BONUSPENJUALAN' => $query[$key]->BONUSPENJUALAN,
				'JUMLAH' => $query[$key]->JUMLAH,
				'PENJUALANBERSIH' => $query[$key]->PENJUALANBERSIH,
				'HARGAPOKOKPENJUALAN' => $query[$key]->HARGAPOKOKPENJUALAN,
				'LABAKOTOR' => $query[$key]->LABAKOTOR,
				'BIAYAPEGAWAIPEMASARAN' => $query[$key]->BIAYAPEGAWAIPEMASARAN,
				'BIAYAPERJALANAN' => $query[$key]->BIAYAPERJALANAN,
				'BIAYASOPIR' => $query[$key]->BIAYASOPIR,
				'BIAYAPROMOSIIKLAN' => $query[$key]->BIAYAPROMOSIIKLAN,
				'BIAYAPENJUALAN' => $query[$key]->BIAYAPENJUALAN,
				'BIAYAPOSTEL' => $query[$key]->BIAYAPOSTEL,
				'BIAYAGUDANGJADI' => $query[$key]->BIAYAGUDANGJADI,
				'BIAYAPEMELIHARAANJENDARAAN' => $query[$key]->BIAYAPEMELIHARAANJENDARAAN,
				'BIAYAPENYUSUTANKENDARAAN' => $query[$key]->BIAYAPENYUSUTANKENDARAAN,
				'JUMLAHBIAYAOPERASIONAL' => $query[$key]->JUMLAHBIAYAOPERASIONAL,
				'LABAOPERASIONAL' => $query[$key]->LABAOPERASIONAL,
				'BIAYADIREKSIPEGAWAI' => $query[$key]->BIAYADIREKSIPEGAWAI,
				'BIAYAPERJALANAN2' => $query[$key]->BIAYAPERJALANAN2,
				'BIAYAKANTOR' => $query[$key]->BIAYAKANTOR,
				'BIAYAPAMPLNASURANSI' => $query[$key]->BIAYAPAMPLNASURANSI,
				'BIAYABANK' => $query[$key]->BIAYABANK,
				'PAJAKPEMDAASTEK' => $query[$key]->PAJAKPEMDAASTEK,
				'BIAYAPEMELIHARAANAKTIVA' => $query[$key]->BIAYAPEMELIHARAANAKTIVA,
				'BIAYAPENYUSUTANAKTIVA' => $query[$key]->BIAYAPENYUSUTANAKTIVA,
				'JUMLAHBIAYAUMUM' => $query[$key]->JUMLAHBIAYAUMUM,
				'LABARUGIUSAHA' => $query[$key]->LABARUGIUSAHA,
				'BEDAKAS' => $query[$key]->BEDAKAS,
				'KURANGLEBIHBAYAR' => $query[$key]->KURANGLEBIHBAYAR,
				'SELISIHKURS' => $query[$key]->SELISIHKURS,
				'PENDAPATANJASAGIRO' => $query[$key]->PENDAPATANJASAGIRO,
				'PENDAPATANBUNGADEPOSIT' => $query[$key]->PENDAPATANBUNGADEPOSIT,
				'PENDAPATANPENJUALANAKTIVA' => $query[$key]->PENDAPATANPENJUALANAKTIVA,
				'PENDAPATANSEWA' => $query[$key]->PENDAPATANSEWA,
				'PENDAPATANKERUGIANASURANSI' => $query[$key]->PENDAPATANKERUGIANASURANSI,
				'PENDAPATANSAMPLE' => $query[$key]->PENDAPATANSAMPLE,
				'LAINLAIN' => $query[$key]->LAINLAIN,
				'JUMLAHPENDAPATANKERUGIAN' => $query[$key]->JUMLAHPENDAPATANKERUGIAN,
				'LABARUGIBERSIHSEBELUMPAJAK' => $query[$key]->LABARUGIBERSIHSEBELUMPAJAK,
				'PERIODEAWAL' => $query[$key]->PERIODEAWAL,
				'PERIODEAKHIR' => $query[$key]->PERIODEAKHIR,
			));
		}
		$PHPJasperXML->setData($data);
		ob_end_clean();
		$PHPJasperXML->outpage("I");
		
		
		
		
		
	}
	
	
	
		
	
	
	
}
