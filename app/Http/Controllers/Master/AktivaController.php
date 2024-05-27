<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
// ganti 1

use App\Models\Master\Aktiva;
use Illuminate\Http\Request;
use DataTables;
use Auth;
use DB;
use Carbon\Carbon;

// ganti 2
class AktivaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // ganti 3
        return view('master_aktiva.index');
    }

    // ganti 4

    // ganti 4
    public function browse(Request $request)
    {

        
		$aktiva = DB::table('aktiva')->select('KODE', 'NAMA', 'SATUAN')->orderBy('KODE', 'ASC')->get();
	
		return response()->json($aktiva);
		
		
    }



    public function getAktiva()
    {
        // ganti 5

        $aktiva = Aktiva::query();

        // ganti 6

        return Datatables::of($aktiva)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                if (Auth::user()->divisi=="programmer" || Auth::user()->divisi=="owner" || Auth::user()->divisi=="assistant" || Auth::user()->divisi=="accounting" || Auth::user()->divisi=="pembelian" || Auth::user()->divisi=="penjualan") 
                {
                    $btnPrivilege =
                        '
                                <a class="dropdown-item" href="aktiva/edit/' . $row->NO_ID . '">
                                <i class="fas fa-edit"></i>
                                    Edit
                                </a>
                                <hr></hr>
                                <a class="dropdown-item btn btn-danger" onclick="return confirm(&quot; Apakah anda yakin ingin hapus? &quot;)" href="aktiva/delete/' . $row->NO_ID . '">
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
                            <a class="dropdown-item" href="aktiva/show/' . $row->NO_ID . '">
                            <i class="fas fa-eye"></i>
                                Lihat
                            </a>

                            ' . $btnPrivilege . '
                        </div>
                    </div>
                    ';

                return $actionBtn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        // ganti 8
        return view('master_aktiva.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $this->validate(
            $request,
            // GANTI 9

            [
                'KODE'       => 'required|unique:aktiva,KODE',
                'NAMA'       => 'required'
            ]

        );

        // Insert Header

        // ganti 10

        $aktiva = Aktiva::create(
            [
                'KODE'         => ($request['KODE'] == null) ? "" : $request['KODE'],
                'NAMA'         => ($request['NAMA'] == null) ? "" : $request['NAMA'],
                'SATUAN'       => ($request['SATUAN'] == null) ? "" : $request['SATUAN'],
                'USRNM'        => Auth::user()->username,
                'TG_SMP'       => Carbon::now(),
                'USRINS'       => Auth::user()->username,
                'TG_INS'       => Carbon::now()
            ]
        );

        //  ganti 11

        return redirect('/aktiva')->with('statusInsert', 'Data baru berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Master\Rute  $rute
     * @return \Illuminate\Http\Response
     */

    // ganti 12

    public function show(Aktiva $aktiva)
    {

        // ganti 13

        $aktivaData = Aktiva::where('NO_ID', $aktiva->NO_ID)->first();

        // ganti 14
        return view('master_aktiva.show', $aktivaData);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Master\Rute  $rute
     * @return \Illuminate\Http\Response
     */

    // ganti 15

    public function edit(Aktiva $aktiva)
    {

        // ganti 16

        $aktivaData = Aktiva::where('NO_ID', $aktiva->NO_ID)->first();

        // ganti 17 
        return view('master_aktiva.edit', $aktivaData);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Master\Rute  $rute
     * @return \Illuminate\Http\Response
     */

    // ganti 18

    public function update(Request $request, Aktiva $aktiva)
    {

        $this->validate(
            $request,
            [

                // ganti 19

                'KODE'       => 'required',
                'NAMA'       => 'required'
            ]
        );

        // ganti 20

        $aktiva->update(
            [

                'NAMA'       => ($request['NAMA'] == null) ? "" : $request['NAMA'],
                'SATUAN'       => ($request['SATUAN'] == null) ? "" : $request['SATUAN'],			 
				'USRNM'          => Auth::user()->username,
                'TG_SMP'         => Carbon::now(),			 
				'USRINS'          => Auth::user()->username,
                'TG_INS'         => Carbon::now()


            ]
        );


        //  ganti 21

        return redirect('/aktiva')->with('status', 'Data baru berhasil diedit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Master\Rute  $rute
     * @return \Illuminate\Http\Response
     */

    // ganti 22

    public function destroy(Aktiva $aktiva)
    {

        // ganti 23
        $deleteAktiva = Aktiva::find($aktiva->NO_ID);

        // ganti 24

        $deleteAktiva->delete();

        // ganti 
        return redirect('/aktiva')->with('status', 'Data berhasil dihapus');
    }


    public function cekaktiva(Request $request)
    {
        $getItem = DB::SELECT('select count(*) as ADA from aktiva where KODE ="' . $request->KODEAKT . '"');

        return $getItem;
    }
	
    public function getSelectKodeAkt(Request $request)
    {
        $search = $request->search;
        $page = $request->page;
        if ($page == 0) {
            $xa = 0;
        } else {
            $xa = ($page - 1) * 10;
        }
        $perPage = 10;
        
        $hasil = DB::SELECT("SELECT KODE, NAMA, SATUAN from aktiva WHERE (KODE LIKE '%$search%' or NAMA LIKE '%$search%') ORDER BY KODE LIMIT $xa,$perPage ");
        $selectajax = array();
        foreach ($hasil as $row => $value) {
            $selectajax[] = array(
                'id' => $hasil[$row]->KODE,
                'text' => $hasil[$row]->KODE,
                'nama' => $hasil[$row]->NAMA,
                'satuan' => $hasil[$row]->SATUAN,
            );
        }
        $select['total_count'] =  count($selectajax);
        $select['items'] = $selectajax;
        return response()->json($select);
    }
}
