<?php

namespace App\Http\Controllers\FMaster;

use App\Http\Controllers\Controller;
// ganti 1

use App\Models\FMaster\Sup;
use Illuminate\Http\Request;

use Storage;
use DataTables;
use Auth;
use DB;
use Image;
use File;
use Carbon\Carbon;

// ganti 2
class RekeningController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // ganti 3
        return view('futility_rekening.index');
    }

    public function browse()
    {
		$sup = DB::table('sup')->select('*')->orderBy('KODES', 'ASC')->get();
		return response()->json($sup);
	}
    // ganti 4a	

    public function getSup()
    {
        // ganti 5

        $sup = Sup::query();

        // ganti 6

        return Datatables::of($account)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                if (Auth::user()->divisi=="programmer" || Auth::user()->divisi=="owner" || Auth::user()->divisi=="assistant" || Auth::user()->divisi=="accounting") 
                {
                    $btnPrivilege =
                        '
                                <a class="dropdown-item" href="rekening/edit/' . $row->NO_ID . '">
                                <i class="fas fa-edit"></i>
                                    Edit
                                </a>
                                <hr></hr>
                                <a class="dropdown-item btn btn-danger" onclick="return confirm(&quot; Apakah anda yakin ingin hapus? &quot;)" href="rekening/delete/' . $row->NO_ID . '">
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
                            <a class="dropdown-item" href="rekening_supplier/show/' . $row->NO_ID . '">
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
        return view('master_account.create');
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
                'ACNO'       => 'required',
                'NAMA'      => 'required'
            ]
        );

        // Insert Header

        // ganti 10
        // Set Folder Tujuan Upload

        // $pic01xExt      = '';
        // $pic01x     = 'noimage.jpg';
			
        // $folder = public_path('uploads/account/');

        //     if ($request->PIC01) 
        //     {

        //         $pic01Ext         = $request->PIC01->extension();             
        //         $pic01File        = $request->file('PIC01');
        //         $pic01x           = $pic01File .$pic01Ext;
        //         $img_pic01Size = Image::make($pic01File->path());
        //         $img_pic01Size->resize(800, 500, function ($constraint){
        //             $constraint->aspectRatio();
        //         })->save($folder . '/' . $pic01x);
        //     }
			

        $account = Account::create(
            [
                'ACNO'            => $request['ACNO'],
                'NAMA'            => $request['NAMA'],
                'BNK'             => ($request['BNK'] == null) ? "" : $request['BNK'],
                'KEL'             => $request['KEL'],
                'NAMA_KEL'        => $request['NAMA_KEL'],
                'POS2'            => $request['POS2'],
                'created_by'      => Auth::user()->username,
				// 'PIC01'           => $pic01x


				
            ]
        );

        //  ganti 11

        return redirect('/account')->with('status', 'Data baru berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Master\Rute  $rute
     * @return \Illuminate\Http\Response
     */

    // ganti 12

    public function show(Account $account)
    {

        // ganti 13

        $accountData = Account::where('NO_ID', $account->NO_ID)->first();

        // ganti 14
        return view('master_account.show', $brgData);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Master\Rute  $rute
     * @return \Illuminate\Http\Response
     */

    // ganti 15

    public function edit(Account $account)
    {

        // ganti 16

        $accountData = Account::where('NO_ID', $account->NO_ID)->first();

        // ganti 17 
        return view('master_account.edit', $accountData);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Master\Rute  $rute
     * @return \Illuminate\Http\Response
     */

    // ganti 18

    public function update(Request $request, Account $account)
    {

        $this->validate(
            $request,
            [

                // ganti 19

                'ACNO'       => 'required',
                'NAMA'      => 'required'
            ]
        );

        // ganti 20

        $account->update(
            [

                'NAMA'           => $request['NAMA'],
                'BNK'            => ($request['BNK'] == null) ? "" : $request['BNK'],
                'KEL'            => $request['KEL'],
                'NAMA_KEL'       => $request['NAMA_KEL'],
                'POS2'           => $request['POS2'],
                'updated_by'     => Auth::user()->username

            ]
        );


        //  ganti 21

        return redirect('/account')->with('status', 'Data baru berhasil diedit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Master\Rute  $rute
     * @return \Illuminate\Http\Response
     */

    // ganti 22

    public function destroy(Account $account)
    {

        // ganti 23
		 $account->update(
            [
                'deleted_by'     => Auth::user()->username
            ]
        );
		
        $deleteAccount = Account::find($account->NO_ID);

        // ganti 24

        $deleteAccount->delete();

        // ganti 
        return redirect('/account')->with('status', 'Data berhasil dihapus');
    }

    public function cekacc(Request $request)
    {
        $getItem = DB::SELECT('select count(*) as ADA from account where ACNO ="' . $request->ACNO . '"');

        return $getItem;
    }
}
