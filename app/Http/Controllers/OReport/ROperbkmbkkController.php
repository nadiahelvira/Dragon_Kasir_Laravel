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

class ROperbkmbkkController extends Controller
{

    public function report()
    {
		session()->put('filter_tglLama', date("d-m-Y"));
		session()->put('filter_tglBaru', date("d-m-Y"));
		session()->put('filter_nobukti1', '');
		session()->put('filter_nobukti2', 'ZZZ');
		session()->put('filter_nobaru', '');
		session()->put('filter_type', '');

        return view('oreport_operbkmbkk.report')->with(['hasil' => []]);
    }
	 
	 
	public function jasperOperbkmbmkkReport(Request $request) 
	{
		
	    // $file 	= 'bankn';
		$PHPJasperXML = new PHPJasperXML();
		$PHPJasperXML->load_xml_file(base_path() . ('/app/reportc01/phpjasperxml/' . $file . '.jrxml'));
		
		// Check Filter
		
		if (!empty($request->tglLama) && !empty($request->tglBaru))
		{
			$tglLamaD = date("Y-m-d", strtotime($request->tglLama));
			$tglBaruD = date("Y-m-d", strtotime($request->tglBaru));
			$filtertgl = " AND kas.TGL between '".$tglLamaD."' and '".$tglBaruD."' ";
		}
		
		if (!empty($request->nobukti1) && !empty($request->nobukti2))
		{
			$nobukti1x = $request->nobukti1;
			$nobukti2x = $request->nobukti2;
			$filternobukti = " AND kas.NO_BUKTI between '".$nobukti1x."' and '".$nobukti2x."'  ";
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
		$TYPEX = $request->TYPE;
		$periodebaru = substr($tgl_baru,5,2) . '/' . substr($tgl_baru,0,4);

		
		if ( $request->pilihan =='0' )
		{
		
		
			$query = DB::SELECT(
						
					"SELECT kas.NO_ID AS NO_ID, 
							kas.NO_BUKTI AS NO_BUKTI,
							kas.TGL AS TGL,
							kas.KET AS KET,
							kas.JUMLAH AS JUMLAH
					FROM kas WHERE kas.PER='$per' AND TRIM(TYPE)=TRIM('$TYPEX') AND TRIM(NO_BUKTI) >= TRIM('$NOMAW') AND  TRIM(NO_BUKTI) <= TRIM('$NOMAK') 
					ORDER BY kas.NO_BUKTI"
			);
			
		}
		
		else
		{
			  DB::SELECT('CALL akt_opernobuktikas_all(?,?,?,?,?)', array($TYPEX, $per, $NOMAW, $NOMAK, $NOMX));;
		
		      $query = DB::SELECT(
		
					"SELECT kas.NO_ID AS NO_ID, 
							kas.NO_BUKTI AS NO_BUKTI,
							kas.TGL AS TGL,
							kas.KET AS KET,
							kas.JUMLAH AS JUMLAH
					FROM kas WHERE kas.PER='$per' AND TRIM(TYPE)=TRIM('$TYPEX') AND TRIM(NO_BUKTI) >= TRIM('$NOMAW') AND  TRIM(NO_BUKTI) <= TRIM('$NOMAK') 
					ORDER BY kas.NO_BUKTI"
			    );
			
			
		}
		
		
	    // kembalikan filter2-an
		
		session()->put('filter_tglLama', $request->tglLama);
		session()->put('filter_tglBaru', $request->tglBaru);
		session()->put('filter_nobukti1', $request->nobukti1);
		session()->put('filter_nobukti2', $request->nobukti2);
		session()->put('filter_nobaru', $request->nobaru);
		session()->put('filter_type', $request->TYPE);
		
		
	
		return view('oreport_operbkmbkk.report')->with(['hasil' => $query]);
		
		
	}
	
	

	
}
