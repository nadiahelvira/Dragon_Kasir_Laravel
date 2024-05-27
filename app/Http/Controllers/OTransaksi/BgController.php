<?php

namespace App\Http\Controllers\OTransaksi;

use App\Http\Controllers\Controller;
use App\Http\Traits\Terbilang;

use App\Models\OTransaksi\Bg;
use Illuminate\Http\Request;
use DataTables;
use Auth;
use DB;
use Carbon\Carbon;


include_once base_path() . "/vendor/simitgroup/phpjasperxml/version/1.1/PHPJasperXML.inc.php";

use PHPJasperXML;


class BgController extends Controller
{
	use Terbilang;

    public function index(Request $request)
    {

        


        return view('otransaksi_bg.index');
    }


    public function browse(Request $request)
    {
        //$bg = DB::table('bg')->select('NO_BUKTI', 'TGL', 'KODES','NAMAS', 'ALAMAT','KOTA', 'TOTAL','BAYAR','SISA')->where('KODES', $request['KODES'] )->where('SISA', '<>', 0 )->where('GOL', 'Y')->orderBy('KODES', 'ASC')->get();



        $bg = DB::SELECT("SELECT NO_BUKTI,TGL, NO_PO, KODES, NAMAS, ALAMAT, KOTA,KD_BRG, NA_BRG, KG, HARGA, ( JCONT- SCONT ) AS KIRIM, SCONT AS SISA, NOTES, RPRATE, EMKL, BL, AJU  from bg
		WHERE  SCONT > 0 and GOL='Y' ORDER BY KODES; ");

        return response()->json($bg);
    }

  

    public function getBg(Request $request)
    {
        if ($request->session()->has('periode')) {
            $periode = $request->session()->get('periode')['bulan'] . '/' . $request->session()->get('periode')['tahun'];
        } else {
            $periode = '';
        }

        $bg = DB::table('bg')->select('*')->where('PER', $periode)->orderBy('NO_BUKTI', 'ASC')->get();


        
         return Datatables::of($bg)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                if (Auth::user()->divisi=="programmer" || Auth::user()->divisi=="owner" || Auth::user()->divisi=="assistant") 
                {
                     $btnEdit = 'onclick= href="bg/edit/' . $row->NO_ID . '" ';
                    $btnDelete = ($row->POSTED == 1) ? ' onclick= "alert(\'Transaksi ' . $row->NO_BUKTI . ' sudah diposting!\')" href="#" ' : ' href="bg/delete/' . $row->NO_ID . '" ';

                    $btnPrivilege =
                        '
                                <a class="dropdown-item" ' . $btnEdit . '>
                                <i class="fas fa-edit"></i>
                                    Edit
                                </a>
                                <a class="dropdown-item btn btn-danger" href="bg/print/' . $row->NO_ID . '">
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
            return redirect('/bg')->with('status', 'Maaf Periode sudah ditutup!');
        } */
		
        return view('otransaksi_bg.create');
    }

    public function store(Request $request)
    {

        $this->validate(
            $request,
            [
           //     'NO_PO'       => 'required',
                'TGL'      => 'required',

            ]
        );

        // Generate Nomor Bukti
        $periode = $request->session()->get('periode')['bulan'] . '/' . $request->session()->get('periode')['tahun'];

        $bulan    = session()->get('periode')['bulan'];
        $tahun    = substr(session()->get('periode')['tahun'], -2);
        $query = DB::table('bg')->select(DB::raw("TRIM(NO_BUKTI) AS NO_BUKTI"))->where('PER', $periode)->orderByDesc('NO_BUKTI')->limit(1)->get();

        if ($query != '[]') {
            $query = substr($query[0]->NO_BUKTI, -4);
            $query = str_pad($query + 1, 4, 0, STR_PAD_LEFT);
            $no_bukti = 'CETAK' . $tahun . $bulan . '-' . $query;
        } else {
            $no_bukti = 'CETAK' . $tahun . $bulan . '-0001';
        }

        // Insert Header
        $bg = Bg::create(
            [
                'NO_BUKTI'         => $no_bukti,
                'TGL'              => date('Y-m-d', strtotime($request['TGL'])),
                'JTEMPO'              => date('Y-m-d', strtotime($request['JTEMPO'])),
                'PER'              => $periode,
                'JENIS'            => ($request['JENIS'] == null) ? "" : $request['JENIS'],
                'SERIES'            => ($request['SERIES'] == null) ? "" : $request['SERIES'],
                'PERUSAHAAN'            => ($request['PERUSAHAAN'] == null) ? "" : $request['PERUSAHAAN'],
                'NOREK'            => ($request['NOREK'] == null) ? "" : $request['NOREK'],
                'PENERIMA'           => ($request['PENERIMA'] == null) ? "" : $request['PENERIMA'],
                'NM_PENGIRIM'           => ($request['NM_PENGIRIM'] == null) ? "" : $request['NM_PENGIRIM'],
                'ALM_PENGIRIM'           => ($request['ALM_PENGIRIM'] == null) ? "" : $request['ALM_PENGIRIM'],
                'TELP_PENGIRIM'           => ($request['TELP_PENGIRIM'] == null) ? "" : $request['TELP_PENGIRIM'],
                'NOREK_PENGIRIM'           => ($request['NOREK_PENGIRIM'] == null) ? "" : $request['NOREK_PENGIRIM'],
                'ALM_PENERIMA'             => ($request['ALM_PENERIMA'] == null) ? "" : $request['ALM_PENERIMA'],
                'FLAG'             => 'BG',
                'BANK_PENERIMA'            => ($request['BANK_PENERIMA'] == null) ? "" : $request['BANK_PENERIMA'],
                'ALM_BANK'           => ($request['ALM_BANK'] == null) ? "" : $request['ALM_BANK'],
                'PEMBAYARAN'           => ($request['PEMBAYARAN'] == null) ? "" : $request['PEMBAYARAN'],
                'JUMLAH'               => (float) str_replace(',', '', $request['JUMLAH']),
                'BIAYA'               => (float) str_replace(',', '', $request['BIAYA']),
                'PAKAI'            => (float) str_replace(',', '', $request['PAKAI']),
                'REVISI'            => (float) str_replace(',', '', $request['REVISI']),						
                'USRNM'            => Auth::user()->username,
                'created_by'       => Auth::user()->username,
                'TG_SMP'           => Carbon::now()
            ]
        );

        // $variablell = DB::select('call bgins(?)', array($no_bukti));
        return redirect('/bg')->with('status', 'Data baru '.$no_bukti.' berhasil ditambahkan');
    }

    public function show(Bg $bg)
    {
        $no_bukti = $bg->NO_BUKTI;
        $data = [
            'header'        => $bg
        ];

        return view('otransaksi_bg.show', $data);
    }

    public function edit(Bg $bg)
    {
		$per = session()->get('periode')['bulan'] . '/' . session()->get('periode')['tahun'];
		$periode = session()->get('periode')['bulan'] . '/' . session()->get('periode')['tahun'];
/*         $cekperid = DB::SELECT("SELECT POSTED from perid WHERE PERIO='$per'");
        if ($cekperid[0]->POSTED==1)
        {
            return redirect('/bg')->with('status', 'Maaf Periode sudah ditutup!');
        } */
		
		
        $no_bukti = $bg->NO_BUKTI;
        $data = Bg::where('NO_BUKTI', $bg->NO_BUKTI)->first();

        return view('otransaksi_bg.edit', $data);
    }

    public function update(Request $request, Bg $bg)
    {
        $this->validate(
            $request,
            [
                'TGL'      => 'required',
             //   'NO_PO'       => 'required',
             //   'KODES'       => 'required',
             //   'KD_BRG'       => 'required'
            ]
        );

     //   $variablell = DB::select('call bgdel(?)', array($bg['NO_BUKTI']));

        $bg->update(
            [
                'TGL'              => date('Y-m-d', strtotime($request['TGL'])),
                'JTEMPO'           => date('Y-m-d', strtotime($request['JTEMPO'])),
                // 'PER'              => $periode,
                'JENIS'            => ($request['JENIS'] == null) ? "" : $request['JENIS'],
                'SERIES'            => ($request['SERIES'] == null) ? "" : $request['SERIES'],
                'PERUSAHAAN'            => ($request['PERUSAHAAN'] == null) ? "" : $request['PERUSAHAAN'],
                'NOREK'            => ($request['NOREK'] == null) ? "" : $request['NOREK'],
                'PENERIMA'           => ($request['PENERIMA'] == null) ? "" : $request['PENERIMA'],
                'NM_PENGIRIM'           => ($request['NM_PENGIRIM'] == null) ? "" : $request['NM_PENGIRIM'],
                'ALM_PENGIRIM'           => ($request['ALM_PENGIRIM'] == null) ? "" : $request['ALM_PENGIRIM'],
                'TELP_PENGIRIM'           => ($request['TELP_PENGIRIM'] == null) ? "" : $request['TELP_PENGIRIM'],
                'NOREK_PENGIRIM'           => ($request['NOREK_PENGIRIM'] == null) ? "" : $request['NOREK_PENGIRIM'],
                'ALM_PENERIMA'             => ($request['ALM_PENERIMA'] == null) ? "" : $request['ALM_PENERIMA'],
                'FLAG'             => 'BG',
                'BANK_PENERIMA'            => ($request['BANK_PENERIMA'] == null) ? "" : $request['BANK_PENERIMA'],
                'ALM_BANK'           => ($request['ALM_BANK'] == null) ? "" : $request['ALM_BANK'],
                'PEMBAYARAN'           => ($request['PEMBAYARAN'] == null) ? "" : $request['PEMBAYARAN'],
                'JUMLAH'               => (float) str_replace(',', '', $request['JUMLAH']),
                'BIAYA'               => (float) str_replace(',', '', $request['BIAYA']),
                'PAKAI'            => (float) str_replace(',', '', $request['PAKAI']),
                'REVISI'            => (float) str_replace(',', '', $request['REVISI']),
                'USRNM'            => Auth::user()->username,
                'updated_by'       => Auth::user()->username,
                'TGL_BL'         => date('Y-m-d', strtotime($request['TGL_BL'])),
                'TG_SMP'           => Carbon::now()
            ]
        );

   //     $variablell = DB::select('call bgins(?)', array($bg['NO_BUKTI']));
        return redirect('/bg')->with('status', 'Data '.$bg->NO_BUKTI.' berhasil diedit');
    }

    public function destroy(Bg $bg)
    {

		$per = session()->get('periode')['bulan'] . '/' . session()->get('periode')['tahun'];
/*         $cekperid = DB::SELECT("SELECT POSTED from perid WHERE PERIO='$per'");
        if ($cekperid[0]->POSTED==1)
        {
            return redirect('/bg')->with('status', 'Maaf Periode sudah ditutup!');
        }
				 */
     //   $variablell = DB::select('call bgdel(?)', array($bg['NO_BUKTI']));

        $deleteBg = Bg::find($bg->NO_ID);
        $deleteBg->delete();

        return redirect('/bg')->with('status', 'Data '.$bg->NO_BUKTI.' berhasil dihapus');
    }



    public function cetak(Bg $bg, Request $request)
    {

		$jenisx = $bg->JENIS;
		$no_bukti = $bg->NO_BUKTI;
		$file ='';
		 
		if ( $jenisx == 'SLIP-TRANSFER' ) {
             $file     = 'Transaksi_CekBG_Tranfer';
	    } else if ( $jenisx == 'SLIP-SETORAN' ) {
			 $file     = 'Transaksi_CekBG_Slip_Storan';
		} else if ( $jenisx == 'CEK-BRI' ) {
			 $file     = 'Transaksi_CekBG_Cek_Bri';
		} else if ( $jenisx == 'CEK' ) {
			 $file     = 'Transaksi_CekBG_Cek_Bca';
		} else if ( $jenisx == 'BILYET-GIRO' ) {
			 $file     = 'Transaksi_CekBG_Cek_BG';
		}
        $PHPJasperXML = new PHPJasperXML();
        $PHPJasperXML->load_xml_file(base_path() . ('/app/reportc01/phpjasperxml/' . $file . '.jrxml'));

		$terbilangx = ucwords($this->pembilang($bg->JUMLAH));
		$PHPJasperXML->arrayParameter = array("TERBILANG" => (string) $terbilangx);
				
		$query = DB::SELECT(

		"SELECT *
			FROM bg
			WHERE NO_BUKTI='" . $no_bukti . "' "
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
                'JUMLAH' => $query[$key]->JUMLAH,
                'JUMLAH_TERBILANG' => $terbilangx,
				//'JUMLAH_TERBILANG' => ucwords($this->pembilang($query[$key]->TJUMLAH)),
            ));
		}     
        $PHPJasperXML->setData($data);
        ob_end_clean();
        $PHPJasperXML->outpage("I");
    }


}