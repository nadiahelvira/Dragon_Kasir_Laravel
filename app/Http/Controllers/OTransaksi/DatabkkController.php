<?php

namespace App\Http\Controllers\OTransaksi;

use App\Http\Controllers\Controller;

use App\Models\OTransaksi\Databkk;
use Illuminate\Http\Request;
use DataTables;
use Auth;
use DB;
use Carbon\Carbon;

class DatabkkController extends Controller
{

    public function index(Request $request)
    {
		
        return view('otransaksi_databkk.index');
    }


    public function browse(Request $request)
    {

        $slip = DB::SELECT("SELECT NO_BUKTI from pemasarankas ");

        return response()->json($slip);
    }

  

    public function getDatabkk(Request $request)
    {
        if ($request->session()->has('periode')) {
            $periode = $request->session()->get('periode')['bulan'] . '/' . $request->session()->get('periode')['tahun'];
        } else {
            $periode = '';
        }

        $databkk = DB::table('pemasarankas')->select('*')->where('PER', $periode)->orderBy('NO_BUKTI', 'ASC')->get();


        
         return Datatables::of($slip)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                if (Auth::user()->divisi=="programmer" || Auth::user()->divisi=="owner" || Auth::user()->divisi=="assistant") 
                {
                     $btnEdit = 'onclick= href="databkk/edit/' . $row->NO_ID . '" ';
                    $btnDelete = ($row->POSTED == 1) ? ' onclick= "alert(\'Transaksi ' . $row->NO_BUKTI . ' sudah diposting!\')" href="#" ' : ' href="databkk/delete/' . $row->NO_ID . '" ';

                    $btnPrivilege =
                        '
                                <a class="dropdown-item" ' . $btnEdit . '>
                                <i class="fas fa-edit"></i>
                                    Edit
                                </a>
                                <a class="dropdown-item btn btn-danger" href="jasper-slip-trans/' . $row->NO_ID . '">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
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
		
        return view('otransaksi_databkk.create');
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
                'TGL'              => date('Y-m-d', strtotime($request['TGL'])),
                'JTEMPO'              => date('Y-m-d', strtotime($request['JTEMPO'])),
                'PER'              => $periode,
                'NAMA'            => ($request['NAMA'] == null) ? "" : $request['NAMA'],
                'WILAYAH'            => ($request['WILAYAH'] == null) ? "" : $request['WILAYAH'],
                'WILAYAH1'            => ($request['WILAYAH1'] == null) ? "" : $request['WILAYAH1'],
                'BANK'            => ($request['BANK'] == null) ? "" : $request['BANK'],
                'ALAMAT'           => ($request['ALAMAT'] == null) ? "" : $request['ALAMAT'],
                'KOTA'         => ($request['KOTA'] == null) ? "" : $request['KOTA'],
                'FLAG'             => 'SL',
                'GAJI_OS'            => ($request['GAJI_OS'] == null) ? "" : $request['GAJI_OS'],
                'TELPON1'           => ($request['TELPON1'] == null) ? "" : $request['TELPON1'],
                'NOREK'           => ($request['NOREK'] == null) ? "" : $request['NOREK'],
				'TOTAL'               => (float) str_replace(',', '', $request['TOTAL']),				
				'BIAYA'               => (float) str_replace(',', '', $request['BIAYA']),				
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
                'TGL'      => 'required',
             //   'NO_PO'       => 'required',
             //   'KODES'       => 'required',
             //   'KD_BRG'       => 'required'
            ]
        );

     //   $variablell = DB::select('call slipdel(?)', array($slip['NO_BUKTI']));

        $slip->update(
            [
                'TGL'              => date('Y-m-d', strtotime($request['TGL'])),
                'JTEMPO'              => date('Y-m-d', strtotime($request['JTEMPO'])),
                // 'PER'             => $periode,
                'NAMA'            => ($request['NAMA'] == null) ? "" : $request['NAMA'],
                'WILAYAH'            => ($request['WILAYAH'] == null) ? "" : $request['WILAYAH'],
                'WILAYAH1'            => ($request['WILAYAH1'] == null) ? "" : $request['WILAYAH1'],
                'BANK'            => ($request['BANK'] == null) ? "" : $request['BANK'],
                'NOREK'            => ($request['NOREK'] == null) ? "" : $request['NOREK'],
                'ALAMAT'           => ($request['ALAMAT'] == null) ? "" : $request['ALAMAT'],
                'KOTA'         => ($request['KOTA'] == null) ? "" : $request['KOTA'],
                'FLAG'             => 'SL',
                'GAJI_OS'            => ($request['GAJI_OS'] == null) ? "" : $request['GAJI_OS'],
                'TELPON1'           => ($request['TELPON1'] == null) ? "" : $request['TELPON1'],
				'TOTAL'               => (float) str_replace(',', '', $request['TOTAL']),			
				'BIAYA'               => (float) str_replace(',', '', $request['BIAYA']),			
                'USRNM'            => Auth::user()->username,
                'updated_by'       => Auth::user()->username,
                'TGL_BL'         => date('Y-m-d', strtotime($request['TGL_BL'])),
                'TG_SMP'           => Carbon::now()
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

    /* public function repost(Slip $slip)
    {
        DB::SELECT("UPDATE slip SET POSTED=0 WHERE NO_ID=".$slip->NO_ID." AND FLAG in ('BD','BN')");
        return redirect('/slipn')->with('status', 'Data '.$slip->NO_BUKTI.' berhasil dibuka posting');
    } */
}