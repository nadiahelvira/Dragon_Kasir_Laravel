<?php

namespace App\Http\Controllers\FMaster;

use App\Http\Controllers\Controller;
use App\Models\FMaster\Sup;
use Illuminate\Http\Request;
use DataTables;
use Auth;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;


class SupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('fmaster_sup.index');
    }


    public function browse(Request $request)
    {

       $sup = DB::SELECT("SELECT KODES, NAMAS, NOREK from
        	   SUP ORDER BY KODES ");
	     
        return response()->json($sup);
    }


    public function getSup()
    {

       $sup = DB::SELECT("SELECT NO_ID, KODES, NAMAS, NOREK from SUP ORDER BY KODES ");
	   


        return Datatables::of($sup)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                if (Auth::user()->divisi=="programmer" || Auth::user()->divisi=="owner" || Auth::user()->divisi=="assistant" || Auth::user()->divisi=="accounting" || Auth::user()->divisi=="pembelian" || Auth::user()->divisi=="penjualan") 
                {
                    $btnPrivilege =
                        '
                                <a class="dropdown-item" href="sup/edit/' . $row->NO_ID . '">
                                <i class="fas fa-edit"></i>
                                    Edit
                                </a>
                                <hr></hr>
                                <a class="dropdown-item btn btn-danger" onclick="return confirm(&quot; Apakah anda yakin ingin hapus? &quot;)" href="sup/delete/' . $row->NO_ID . '">
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('fmaster_sup.create');
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
            // GANTI 8 SESUAI NAMA KOLOM DI NAVICAT //
            [
                'KODES'       => 'required',
                'NAMAS'       => 'required'
            ]
        );

        // Insert Header

        $query = DB::table('SUP')->select('KODES')->orderByDesc('KODES')->limit(1)->get();
		
        $sup = Sup::create(
            [

            ]

        );


        return redirect('/sup')->with('statusInsert', 'Data baru berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FMaster\Rute  $rute
     * @return \Illuminate\Http\Response
     */
    public function show(Sup $sup)
    {

        $supData = Sup::where('NO_ID', $sup->NO_ID)->first();
        return view('fmaster_sup.show', $supData);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FMaster\Rute  $rute
     * @return \Illuminate\Http\Response
     */
    public function edit(Sup $sup)
    {
        $supData = Sup::where('KODES', $sup->KODES)->first();
        return view('fmaster_sup.edit', $supData);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FMaster\Rute  $rute
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sup $sup)
    {

        $this->validate(
            $request,
            [
                'KODES'       => 'required',
                'NAMAS'      => 'required'
            ]
        );


        $sup->update(
            [

                'NAMAS'         => ($request['NAMAS'] == null) ? "" : $request['NAMAS'],
                'NOREK'        => ($request['NOREK'] == null) ? "" : $request['BANK_REK'],
				'USRNM'         => Auth::user()->username,
                'TG_SMP'        => Carbon::now()
            ]
        );


        return redirect('/sup')->with('status', 'Data baru berhasil diedit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FMaster\Rute  $rute
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sup $sup)
    {
        $deleteSup = Sup::find($sup->NO_ID);
        $deleteSup->delete();

        return redirect('/sup')->with('status', 'Data berhasil dihapus');
    }

    public function ceksup(Request $request)
    {
        $getItem = DB::SELECT('select count(*) as ADA from SUP where KODES ="' . $request->KODES . '"');

        return $getItem;
    }
	
    public function getSelectKodes(Request $request)
    {
        $search = $request->search;
        $page = $request->page;
        if ($page == 0) {
            $xa = 0;
        } else {
            $xa = ($page - 1) * 10;
        }
        $perPage = 10;
        
        $hasil = DB::SELECT("SELECT KODES, NAMAS from SUP WHERE (KODES LIKE '%$search%' or NAMAS LIKE '%$search%') ORDER BY KODES LIMIT $xa,$perPage ");
        $selectajax = array();
        foreach ($hasil as $row => $value) {
            $selectajax[] = array(
                'id' => $hasil[$row]->KODES,
                'text' => $hasil[$row]->KODES,
                'namas' => $hasil[$row]->NAMAS,
            );
        }
        $select['total_count'] =  count($selectajax);
        $select['items'] = $selectajax;
        return response()->json($select);
    }
}
