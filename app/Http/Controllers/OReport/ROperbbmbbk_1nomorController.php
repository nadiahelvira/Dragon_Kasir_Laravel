<?php

namespace App\Http\Controllers\OReport;

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

class ROperbbmbbk_1nomorController extends Controller
{

    public function report()
    {
		session()->put('filter_tglLama', date("d-m-Y"));
		session()->put('filter_tglBaru', date("d-m-Y"));
		session()->put('filter_nobukti1', '');
		session()->put('filter_nobukti2', '');
		session()->put('filter_nobaru', '');
		session()->put('filter_type', '');

        return view('oreport_operbbmbbk_1nomor.report')->with(['hasil' => []]);
    }
	 
	 
	public function jasperOperbbmbbk_1nomorReport(Request $request) 
	{
		
	    // $file 	= 'bankn';
		$PHPJasperXML = new PHPJasperXML();
		$PHPJasperXML->load_xml_file(base_path() . ('/app/reportc01/phpjasperxml/' . $file . '.jrxml'));
		
		// Check Filter
		
		if (!empty($request->tglLama) && !empty($request->tglBaru))
		{
			$tglLamaD = date("Y-m-d", strtotime($request->tglLama));
			$tglBaruD = date("Y-m-d", strtotime($request->tglBaru));
			$filtertgl = " AND bank.TGL between '".$tglLamaD."' and '".$tglBaruD."' ";
		}
		
		if (!empty($request->nobukti1) && !empty($request->nobukti2))
		{
			$nobukti1x = $request->nobukti1;
			$nobukti2x = $request->nobukti2;
			$filternobukti = " AND bank.NO_BUKTI between '".$nobukti1x."' and '".$nobukti2x."'  ";
		}
		
		if ($request->session()->has('periode')) 
		{
			$per = $request->session()->get('periode')['bulan']. '/' . $request->session()->get('periode')['tahun'];
		} else
		{
			$per = '';
		}
		
	
		$tgl_lama = date("Y-m-d", strtotime($request->tglLama));
		$tgl_baru = date("Y-m-d", strtotime($request->tglBaru));
		$NOMAW = $request->nobukti1;
		$NOMAK = $request->nobukti2;
		$NOMX = $request->nobaru;
		$TYPEX = $request->type;
		$periodebaru = substr($tgl_baru,5,2) . '/' . substr($tgl_baru,0,4);

		
		if ( $request->pilihan =='0' )
		{
		
		
			$query = DB::SELECT(
		
					"SELECT bank.NO_ID AS NO_ID, 
							bank.NO_BUKTI AS NO_BUKTI,
							bank.TGL AS TGL,
							bank.KET AS KET,
							bank.JUMLAH AS JUMLAH
					FROM bank WHERE bank.PER='$per'
					AND TRIM(NO_BUKTI) >= TRIM('$NOMAW') AND  TRIM(NO_BUKTI) <= TRIM('$NOMAW') 
					ORDER BY bank.NO_BUKTI"
			);
			
		}
		
		else
		{
			
			  DB::SELECT('CALL akt_opernobuktibank_all(?,?,?,?,?)', array($TYPEX), array($per), array($NOMAW), array($NOMAW), array($NOMX));
		
		      $query = DB::SELECT(
		
					"SELECT bank.NO_ID AS NO_ID, 
							bank.NO_BUKTI AS NO_BUKTI,
							bank.TGL AS TGL,
							bank.KET AS KET,
							bank.JUMLAH AS JUMLAH
					FROM bank WHERE bank.PER='$per' 
					AND TRIM(NO_BUKTI) >= TRIM('$NOMAW') AND  TRIM(NO_BUKTI) <= TRIM('$NOMAW') 
					ORDER BY bank.NO_BUKTI"
			    );
			
			
		}
		
		
	    // kembalikan filter2-an
		
		session()->put('filter_tglLama', $request->tglLama);
		session()->put('filter_tglBaru', $request->tglBaru);
		session()->put('filter_nobukti1', $request->nobukti1);
		session()->put('filter_nobukti2', $request->nobukti2);
		session()->put('filter_nobaru', $request->nobaru);
		session()->put('filter_type', $request->type);
		
		
	
		return view('oreport_operbbmbbk_1nomor.report')->with(['hasil' => $query]);
		
		
	}
	
	

	
}
