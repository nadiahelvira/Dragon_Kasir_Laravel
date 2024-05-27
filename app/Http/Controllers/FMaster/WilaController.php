<?php

namespace App\Http\Controllers\FMaster;

use App\Http\Controllers\Controller;
// ganti 1

use App\Models\FMaster\Wila;
use Illuminate\Http\Request;
use DataTables;
use Auth;
use DB;
use Carbon\Carbon;

// ganti 2
class WilaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		
// ganti 3
        return view('fmaster_wila.index');
    }

// ganti 4
    public function browse()
    {
		$wila = DB::table('wila')->select('*')->orderBy('KODE', 'ASC')->get();
		return response()->json($wila);
	}
	
	public function browsewilayah()
    {
		$wilayah = DB::table('wilayah')->select('*')->orderBy('WILAYAH', 'ASC')->get();
		return response()->json($wilayah);
	}
	
	
    public function getWila()
    {
// ganti 5

		$wila = DB::table('wila')->select('NO_ID', 'KODE', 'NAMA')->orderBy('KODE', 'ASC')->get();

        return Datatables::of($wila)
                ->addIndexColumn()
                ->addColumn('action', function($row) {
					if (Auth::user()->divisi=="programmer" || Auth::user()->divisi=="owner" || Auth::user()->divisi=="assistant" || Auth::user()->divisi=="accounting" || Auth::user()->divisi=="pembelian" || Auth::user()->divisi=="penjualan") 
					{
                        $btnPrivilege = 
                        '
                                <a class="dropdown-item" href="wila/edit/'. $row->NO_ID .'">
                                <i class="fas fa-edit"></i>
                                    Edit
                                </a>

                                <a class="dropdown-item btn btn-danger" onclick="return confirm(&quot; Apakah anda yakin ingin hapus? &quot;)" href="wila/delete/'. $row->NO_ID .'">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                    Delete
                                </a> 
                        ';
                    } 
                    else
                    {
                        $btnPrivilege = '';
                    }

                    $actionBtn = 
                    '
                    <div class="dropdown show" style="text-align: center">
                        <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-bars"></i>
                        </a>

                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">


                            '.$btnPrivilege.'
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
        return view('fmaster_wila.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        
        $this->validate($request,
// GANTI 9

        [
                'KODE'       => 'required'
            ]
        );

        // Insert Header

// ganti 10

        $wila = Wila::create(
            [
                'KODE'         => ($request['KODE']==null) ? "" : $request['KODE'],	
                'NAMA'         => ($request['NAMA']==null) ? "" : $request['NAMA'],	
                'NO_REK'         => ($request['NO_REK']==null) ? "" : $request['NO_REK'],
                'BANK'         => ($request['BANK']==null) ? "" : $request['BANK'],	
                'ALAMAT'         => ($request['ALAMAT']==null) ? "" : $request['ALAMAT'],
                'KOTA'         => ($request['KOTA']==null) ? "" : $request['KOTA'],	
                'TELPON'         => ($request['TELPON']==null) ? "" : $request['TELPON'],
                'JENIS'         => ($request['JENIS']==null) ? "" : $request['JENIS'],	
				'USRNM'          => Auth::user()->username,
				'TG_SMP'         => Carbon::now()
            ]
        );

//  ganti 11

        return redirect('/wila')->with('statusInsert', 'Data baru berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Master\Rute  $rute
     * @return \Illuminate\Http\Response
     */
	 
// ganti 12
	 
    public function show(Wila $wila)
    {

// ganti 13

        $wilaData = Wila::where('NO_ID', $wila->NO_ID)->first();

// ganti 14
        return view('fmaster_wila.show', $wilaData);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Master\Rute  $rute
     * @return \Illuminate\Http\Response
     */

// ganti 15

    public function edit(Wila $wila)
    {
		
// ganti 16
		
        $wilaData = Wila::where('NO_ID', $wila->NO_ID)->first();

// ganti 17 
        return view('fmaster_wila.edit', $wilaData);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Master\Rute  $rute
     * @return \Illuminate\Http\Response
     */

// ganti 18

    public function update(Request $request, Wila $wila )
    {
		
        $this->validate($request,
        [		
// ganti 19
                'KODE'       => 'required',

            ]
        );
		
// ganti 20

        $wila->update(
            [
              
                'NAMA'         => ($request['NAMA']==null) ? "" : $request['NAMA'],	
                'NO_REK'         => ($request['NO_REK']==null) ? "" : $request['NO_REK'],
                'BANK'         => ($request['BANK']==null) ? "" : $request['BANK'],	
                'ALAMAT'         => ($request['ALAMAT']==null) ? "" : $request['ALAMAT'],
                'KOTA'         => ($request['KOTA']==null) ? "" : $request['KOTA'],	
                'TELPON'         => ($request['TELPON']==null) ? "" : $request['TELPON'],
                'JENIS'         => ($request['JENIS']==null) ? "" : $request['JENIS'],	
				'USRNM'          => Auth::user()->username,
				'TG_SMP'         => Carbon::now()
            ]
        );
//  ganti 21

        return redirect('/wila')->with('status', 'Data baru berhasil diedit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Master\Rute  $rute
     * @return \Illuminate\Http\Response
     */
	 
// ganti 22
	 
    public function destroy(Wila $wila)
    {

// ganti 23
        $deleteWila = Wila::find($wila->NO_ID);

// ganti 24

        $deleteWila->delete();

// ganti 
        return redirect('/wila')->with('status', 'Data berhasil dihapus');
		
		
    }
	
	
	
    public function cek(Request $request)
    {
        $getItem = DB::SELECT('select count(*) as ADA from wila where KODE ="' . $request->KODE . '"');

        return $getItem;
    }
}