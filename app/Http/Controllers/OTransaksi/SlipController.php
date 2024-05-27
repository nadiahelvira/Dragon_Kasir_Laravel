<?php

namespace App\Http\Controllers\OTransaksi;

use App\Http\Controllers\Controller;
use App\Http\Traits\Terbilang;

use App\Models\OTransaksi\Slip;
use Illuminate\Http\Request;
use DataTables;
use Auth;
use DB;
use Carbon\Carbon;

include_once base_path() . "/vendor/simitgroup/phpjasperxml/version/1.1/PHPJasperXML.inc.php";

use PHPJasperXML;

class SlipController extends Controller
{
	use Terbilang;

    public function index(Request $request)
    {
        return view('otransaksi_slip.index');
    }


    public function browse(Request $request)
    {
        //$slip = DB::table('slip')->select('NO_BUKTI', 'TGL_SETOR', 'KODES','NAMAS', 'ALAMAT','KOTA', 'TOTAL','BAYAR','SISA')->where('KODES', $request['KODES'] )->where('SISA', '<>', 0 )->where('GOL', 'Y')->orderBy('KODES', 'ASC')->get();



        $slip = DB::SELECT("SELECT NO_BUKTI,TGL_SETOR, NO_PO, KODES, NAMAS, ALAMAT, KOTA,KD_BRG, NA_BRG, KG, HARGA, ( JCONT- SCONT ) AS KIRIM, SCONT AS SISA, NOTES, RPRATE, EMKL, BL, AJU  from slip
		WHERE  SCONT > 0 and GOL='Y' ORDER BY KODES; ");

        return response()->json($slip);
    }

  

    public function getSlip(Request $request)
    {
        if ($request->session()->has('periode')) {
            $periode = $request->session()->get('periode')['bulan'] . '/' . $request->session()->get('periode')['tahun'];
        } else {
            $periode = '';
        }

        $slip = DB::table('slip')->select('*')->where('PER', $periode)->orderBy('NO_BUKTI', 'ASC')->get();


        
         return Datatables::of($slip)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                if (Auth::user()->divisi=="programmer" || Auth::user()->divisi=="owner" || Auth::user()->divisi=="assistant") 
                {
                     $btnEdit = 'onclick= href="slip/edit/' . $row->NO_ID . '" ';
                    $btnDelete = ($row->POSTED == 1) ? ' onclick= "alert(\'Transaksi ' . $row->NO_BUKTI . ' sudah diposting!\')" href="#" ' : ' href="slip/delete/' . $row->NO_ID . '" ';

                    $btnPrivilege =
                        '
                                <a class="dropdown-item" ' . $btnEdit . '>
                                <i class="fas fa-edit"></i>
                                    Edit
                                </a>
                                <a class="dropdown-item btn btn-danger" href="slip/print/' . $row->NO_ID . '">
                                    <i class="fa fa-print" aria-hidden="true"></i>
                                    Print
                                </a> 									
                                <hr></hr>
                                <a class="dropdown-item btn btn-danger" onclick="return confirm(&quot; Apakah anda yakin ingin hapus? &quot;)" ' . $btnDelete . '>
   
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                    Delete
                                </a> 
                        ';
                } else {
                    $btnPrivilege = '';
                }

                $actionBtn =
                    '
                    <div class="dropdown show" style="text-align: center">
                        <a class="btn btn-secondary dropdown-toggle btn-sm" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-bars"></i>
                        </a>

                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                           

                            ' . $btnPrivilege . '
                        </div>
                    </div>
                    ';

                return $actionBtn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function create()
    {
		$per = session()->get('periode')['bulan'] . '/' . session()->get('periode')['tahun'];
/*         $cekperid = DB::SELECT("SELECT POSTED from perid WHERE PERIO='$per'");
        if ($cekperid[0]->POSTED==1)
        {
            return redirect('/slip')->with('status', 'Maaf Periode sudah ditutup!');
        } */
		
        return view('otransaksi_slip.create');
    }

    public function store(Request $request)
    {

        $this->validate(
            $request,
            [
           //     'NO_PO'       => 'required',
                'TGL_SETOR'      => 'required',

            ]
        );

        // Generate Nomor Bukti
        $periode = $request->session()->get('periode')['bulan'] . '/' . $request->session()->get('periode')['tahun'];

        $bulan    = session()->get('periode')['bulan'];
        $tahun    = substr(session()->get('periode')['tahun'], -2);
        $query = DB::table('slip')->select(DB::raw("TRIM(NO_BUKTI) AS NO_BUKTI"))->where('PER', $periode)->orderByDesc('NO_BUKTI')->limit(1)->get();

        if ($query != '[]') {
            $query = substr($query[0]->NO_BUKTI, -4);
            $query = str_pad($query + 1, 4, 0, STR_PAD_LEFT);
            $no_bukti = 'CETAK' . $tahun . $bulan . '-' . $query;
        } else {
            $no_bukti = 'CETAK' . $tahun . $bulan . '-0001';
        }

        // Insert Header
        $slip = Slip::create(
            [
                'NO_BUKTI'         => $no_bukti,
                'TGL_SETOR'        => date('Y-m-d', strtotime($request['TGL_SETOR'])),
                'JTEMPO'           => date('Y-m-d', strtotime($request['JTEMPO'])),
                'PER'              => $periode,
                'NAMA'             => ($request['NAMA'] == null) ? "" : $request['NAMA'],
                'WILAYAH'          => ($request['WILAYAH'] == null) ? "" : $request['WILAYAH'],
                'WILAYAH1'         => ($request['WILAYAH1'] == null) ? "" : $request['WILAYAH1'],
                'BANK'             => ($request['BANK'] == null) ? "" : $request['BANK'],
                'ALAMAT'           => ($request['ALAMAT'] == null) ? "" : $request['ALAMAT'],
                'KOTA'             => ($request['KOTA'] == null) ? "" : $request['KOTA'],
                'FLAG'             => 'SLIP',
                'GAJI_OS'          => ($request['GAJI_OS'] == null) ? "" : $request['GAJI_OS'],
                'TELPON1'          => ($request['TELPON1'] == null) ? "" : $request['TELPON1'],
                'NOREK'            => ($request['NOREK'] == null) ? "" : $request['NOREK'],
				'TOTAL'            => (float) str_replace(',', '', $request['TOTAL']),				
				'BIAYA'            => (float) str_replace(',', '', $request['BIAYA']),				
                'USRNM'            => Auth::user()->username,
                'created_by'       => Auth::user()->username,
                'TG_SMP'           => Carbon::now()
            ]
        );

        // $variablell = DB::select('call slipins(?)', array($no_bukti));
        return redirect('/slip')->with('status', 'Data baru '.$no_bukti.' berhasil ditambahkan');
    }

    public function show(Slip $slip)
    {
        $no_bukti = $slip->NO_BUKTI;
        $data = [
            'header'        => $slip
        ];

        return view('otransaksi_slip.show', $data);
    }

    public function edit(Slip $slip)
    {

		$per = session()->get('periode')['bulan'] . '/' . session()->get('periode')['tahun'];
/*         $cekperid = DB::SELECT("SELECT POSTED from perid WHERE PERIO='$per'");
        if ($cekperid[0]->POSTED==1)
        {
            return redirect('/slip')->with('status', 'Maaf Periode sudah ditutup!');
        } */
		
		
        $no_bukti = $slip->NO_BUKTI;
        $data = Slip::where('NO_BUKTI', $slip->NO_BUKTI)->first();

        return view('otransaksi_slip.edit', $data);
    }

    public function update(Request $request, Slip $slip)
    {
        $this->validate(
            $request,
            [
                'TGL_SETOR'      => 'required',
             //   'NO_PO'       => 'required',
             //   'KODES'       => 'required',
             //   'KD_BRG'       => 'required'
            ]
        );

     //   $variablell = DB::select('call slipdel(?)', array($slip['NO_BUKTI']));

        $slip->update(
            [
                'TGL_SETOR'             => date('Y-m-d', strtotime($request['TGL_SETOR'])),
                'JTEMPO'              	=> date('Y-m-d', strtotime($request['JTEMPO'])),
                // 'PER'             	=> $periode,
                'NAMA'            		=> ($request['NAMA'] == null) ? "" : $request['NAMA'],
                'WILAYAH'            	=> ($request['WILAYAH'] == null) ? "" : $request['WILAYAH'],
                'WILAYAH1'            	=> ($request['WILAYAH1'] == null) ? "" : $request['WILAYAH1'],
                'BANK'            		=> ($request['BANK'] == null) ? "" : $request['BANK'],
                'NOREK'            		=> ($request['NOREK'] == null) ? "" : $request['NOREK'],
                'ALAMAT'           		=> ($request['ALAMAT'] == null) ? "" : $request['ALAMAT'],
                'KOTA'         			=> ($request['KOTA'] == null) ? "" : $request['KOTA'],
                'FLAG'             		=> 'SLIP',
                'GAJI_OS'            	=> ($request['GAJI_OS'] == null) ? "" : $request['GAJI_OS'],
                'TELPON1'           	=> ($request['TELPON1'] == null) ? "" : $request['TELPON1'],
				'TOTAL'               	=> (float) str_replace(',', '', $request['TOTAL']),			
				'BIAYA'               	=> (float) str_replace(',', '', $request['BIAYA']),			
                'USRNM'            		=> Auth::user()->username,
                'updated_by'       		=> Auth::user()->username,
                'TGL_BL'         		=> date('Y-m-d', strtotime($request['TGL_BL'])),
                'TG_SMP'           		=> Carbon::now()
            ]
        );

   //     $variablell = DB::select('call slipins(?)', array($slip['NO_BUKTI']));
        return redirect('/slip')->with('status', 'Data '.$slip->NO_BUKTI.' berhasil diedit');
    }

    public function destroy(Slip $slip)
    {

		$per = session()->get('periode')['bulan'] . '/' . session()->get('periode')['tahun'];
/*         $cekperid = DB::SELECT("SELECT POSTED from perid WHERE PERIO='$per'");
        if ($cekperid[0]->POSTED==1)
        {
            return redirect('/slip')->with('status', 'Maaf Periode sudah ditutup!');
        }
				 */
     //   $variablell = DB::select('call slipdel(?)', array($slip['NO_BUKTI']));

        $deleteSlip = Slip::find($slip->NO_ID);
        $deleteSlip->delete();

        return redirect('/slip')->with('status', 'Data '.$slip->NO_BUKTI.' berhasil dihapus');
    }


	public function cetak(Slip $slip, Request $request)
    {

		$jenisx = $slip->JENIS;
		
		$file ='Transaksi_FormSlip';
		 
		// if ( $jenisx == 'PMS' ) {
        //      $file     = 'Transaksi_FormSlip';
	    // } else if ( $jenisx == 'GJ' ) {
		// 	 $file     = 'Transaksi_CekBG_Slip_Storan';
		// } else if ( $jenisx == 'CEK BRI' ) {
		// 	 $file     = 'Transaksi_CekBG_Cek_Bri';
		// } else if ( $jenisx == 'CEK BCA' ) {
		// 	 $file     = 'Transaksi_CekBG_Cek_Bca';
		// } else if ( $jenisx == 'BILYET GIRO (BG)' ) {
		// 	 $file     = 'Transaksi_CekBG_Cek_BG';
		// }
        $PHPJasperXML = new PHPJasperXML();
        $PHPJasperXML->load_xml_file(base_path() . ('/app/reportc01/phpjasperxml/' . $file . '.jrxml'));

        $terbilangx = ucwords($this->pembilang($slip->TOTAL));
  //      $PHPJasperXML->arrayParameter = array("TERBILANG" => (string) $terbilangx);
		$query = DB::SELECT(

		"SELECT *
			FROM slip
			WHERE NO_BUKTI='CETAK2401-0001'"
		);

        $data = [];
        foreach ($query as $key => $value) {
	
            array_push($data, array(

                'TGL' => $query[$key]->TGL,
                'NOREK' => $query[$key]->NOREK,
                'JUMLAH' => $query[$key]->JUMLAH,
                'PENERIMA' => $query[$key]->PENERIMA,
                'PERUSAHAAN' => $query[$key]->PERUSAHAAN,
                'BANK_PENERIMA' => $query[$key]->BANK_PENERIMA,
                'ALM_BANK' => $query[$key]-ALM_BANK,
                'NM_PENGIRIM' => $query[$key]->NM_PENGIRIM,
                'ALM_PENGIRIM' => $query[$key]->ALM_PENGIRIM,
                'TELP_PENGIRIM' => $query[$key]->TELP_PENGIRIM,
                'NOREK_PENGIRIM' => $query[$key]->NOREK_PENGIRIM,
                'BIAYA' => $query[$key]->BIAYA,				
                'TOTAL' => $query[$key]->TOTAL,
                'TOTAL_TERBILANG' => $terbilangx
				//'JUMLAH_TERBILANG' => ucwords($this->pembilang($query[$key]->TJUMLAH)),
            ));
        
		}     
		
        $PHPJasperXML->setData($data);
        ob_end_clean();
        $PHPJasperXML->outpage("I");
    }


    /* public function repost(Slip $slip)
    {
        DB::SELECT("UPDATE slip SET POSTED=0 WHERE NO_ID=".$slip->NO_ID." AND FLAG in ('BD','BN')");
        return redirect('/slipn')->with('status', 'Data '.$slip->NO_BUKTI.' berhasil dibuka posting');
    } */
}