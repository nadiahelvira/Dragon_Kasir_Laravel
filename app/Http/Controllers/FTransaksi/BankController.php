<?php

namespace App\Http\Controllers\FTransaksi;

use App\Http\Controllers\Controller;
use App\Http\Traits\Terbilang;
// ganti 1

use App\Models\FTransaksi\Bank;
use App\Models\FTransaksi\BankDetail;
use Illuminate\Http\Request;
use DataTables;
use Auth;
use DB;
use Carbon\Carbon;

include_once base_path() . "/vendor/simitgroup/phpjasperxml/version/1.1/PHPJasperXML.inc.php";

use PHPJasperXML;

// ganti 2
class BankController extends Controller
{
	use Terbilang;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	 
	var $judul = '';
    var $FLAGZ = '';
    var $BACNOZ = '';


    function setFlag(Request $request)
    {
		
		if ( $request->flagz == 'BBK' && $request->bacnoz == '111' ) {
            $this->judul = "Transaksi Bank Keluar BCA Rupiah ";
        } else if ( $request->flagz == 'BBK' && $request->bacnoz == '111.01' ) {
            $this->judul = "Transaksi Bank Keluar BCA USD";
        } else if ( $request->flagz == 'BBK' && $request->bacnoz == '111.02' ) {
            $this->judul = "Transaksi Bank Keluar BCA EURO";
        } else if ( $request->flagz == 'BBK' && $request->bacnoz == '112' ) {
            $this->judul = "Transaksi Bank Keluar UOB IDR";
        } else if ( $request->flagz == 'BBK' && $request->bacnoz == '112.01' ) {
            $this->judul = "Transaksi Bank Keluar UOB USD";
        } else if ( $request->flagz == 'BBK' && $request->bacnoz == '113' ) {
            $this->judul = "Transaksi Bank Keluar HSBC";
        } else if ( $request->flagz == 'BBK' && $request->bacnoz == '114' ) {
            $this->judul = "Transaksi Bank Keluar DANAMON FLEXIMAX";
        } else if ( $request->flagz == 'BBK' && $request->bacnoz == '114.01' ) {
            $this->judul = "Transaksi Bank Keluar DANAMON PROMAGIRO";
        } else if ( $request->flagz == 'BBK' && $request->bacnoz == '114.02' ) {
            $this->judul = "Transaksi Bank Keluar DANAMON USD";
        } else if ( $request->flagz == 'BBK' && $request->bacnoz == '115' ) {
            $this->judul = "Transaksi Bank Keluar ARTOZ IDR";
        } else if ( $request->flagz == 'BBK' && $request->bacnoz == '115.01' ) {
            $this->judul = "Transaksi Bank Keluar ANZ";
        } else if ( $request->flagz == 'BBK' && $request->bacnoz == '116' ) {
            $this->judul = "Transaksi Bank Keluar BRI IDR";
        } else if ( $request->flagz == 'BBK' && $request->bacnoz == '118' ) {
            $this->judul = "Transaksi Bank Keluar PERMATA IDR";
        } else if ( $request->flagz == 'BBK' && $request->bacnoz == '118.01' ) {
            $this->judul = "Transaksi Bank Keluar PERMATA USD";
        }
		
		else if ( $request->flagz == 'BBM' && $request->bacnoz == '111' ) {
            $this->judul = "Transaksi Bank Masuk BCA Rupiah ";
        } else if ( $request->flagz == 'BBM' && $request->bacnoz == '111.01' ) {
            $this->judul = "Transaksi Bank Masuk BCA USD";
        } else if ( $request->flagz == 'BBM' && $request->bacnoz == '111.02' ) {
            $this->judul = "Transaksi Bank Masuk BCA EURO";
        } else if ( $request->flagz == 'BBM' && $request->bacnoz == '112' ) {
            $this->judul = "Transaksi Bank Masuk UOB IDR";
        } else if ( $request->flagz == 'BBM' && $request->bacnoz == '112.01' ) {
            $this->judul = "Transaksi Bank Masuk UOB USD";
        } else if ( $request->flagz == 'BBM' && $request->bacnoz == '113' ) {
            $this->judul = "Transaksi Bank Masuk HSBC";
        } else if ( $request->flagz == 'BBM' && $request->bacnoz == '114' ) {
            $this->judul = "Transaksi Bank Masuk DANAMON FLEXIMAX";
        } else if ( $request->flagz == 'BBM' && $request->bacnoz == '114.01' ) {
            $this->judul = "Transaksi Bank Masuk DANAMON PROMAGIRO";
        } else if ( $request->flagz == 'BBM' && $request->bacnoz == '114.02' ) {
            $this->judul = "Transaksi Bank Masuk DANAMON USD";
        } else if ( $request->flagz == 'BBM' && $request->bacnoz == '115' ) {
            $this->judul = "Transaksi Bank Masuk ARTOZ IDR";
        } else if ( $request->flagz == 'BBM' && $request->bacnoz == '115.01' ) {
            $this->judul = "Transaksi Bank Masuk ANZ";
        } else if ( $request->flagz == 'BBM' && $request->bacnoz == '116' ) {
            $this->judul = "Transaksi Bank Masuk BRI IDR";
        } else if ( $request->flagz == 'BBM' && $request->bacnoz == '118' ) {
            $this->judul = "Transaksi Bank Masuk PERMATA IDR";
        } else if ( $request->flagz == 'BBM' && $request->bacnoz == '118.01' ) {
            $this->judul = "Transaksi Bank Masuk PERMATA USD";
        }
		
		
        $this->FLAGZ = $request->flagz;
        $this->BACNOZ = $request->bacnoz;


    }	 
	
    public function index(Request $request)
    {

        // ganti 3
        $this->setFlag($request);
        // ganti 3
        return view('ftransaksi_bank.index')->with(['judul' => $this->judul, 'bacnoz' => $this->BACNOZ , 'flagz' => $this->FLAGZ ]);
		
    }
	
	public function cari(Request $request)
    {
        

		$type01 = $request['flagz'];
		$bacnoz01 = $request['bacnoz'];
			
        if ($request->session()->has('periode')) {
            $periode = $request->session()->get('periode')['bulan'] . '/' . $request->session()->get('periode')['tahun'];
        } else {
            $periode = '';
        }

        $this->setFlag($request);
		
        $kel = DB::SELECT("SELECT BANK.NO_BUKTI, DATE_FORMAT(BANK.TGL,'%d/%m/%Y') AS TGL, BANKD.ACNO, BANKD.NACNO, BANKD.URAIAN, BANKD.NO_HUT,  BANKD.JUMLAH FROM 
						   BANK, BANKD WHERE BANK.NO_BUKTI = BANKD.NO_BUKTI  AND LEFT(BANK.NO_BUKTI,3)='$type01' AND  BANK.BACNO = '$bacnoz01' AND BANK.PER = '$periode'  ");
 
 
 
		return response()->json($kel);
    }

    // ganti 4

    public function getBank(Request $request)
    {
        // ganti 5

        if ($request->session()->has('periode')) {
            $periode = $request->session()->get('periode')['bulan'] . '/' . $request->session()->get('periode')['tahun'];
        } else {
            $periode = '';
        }

        $this->setFlag($request);
		
        $bank = DB::SELECT("SELECT * from bank  where  PER ='$periode' and TYPE ='$this->FLAGZ' AND BACNO ='$this->BACNOZ' ORDER BY NO_BUKTI ");
	  
        // ganti 6

        return Datatables::of($bank)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                if (Auth::user()->divisi=="programmer" || Auth::user()->divisi=="owner" || Auth::user()->divisi=="assistant" || Auth::user()->divisi=="accounting") 
                {
                    $btnPrivilege =


                    $btnEdit =   ($row->POSTED == 1) ? ' onclick= "alert(\'Transaksi ' . $row->NO_BUKTI . ' sudah diposting!\')" href="#" ' : ' href="bank/edit/?idx=' . $row->NO_ID . '&tipx=edit&flagz=' . $row->TYPE . '&bacnoz=' . $row->BACNO  . '&judul=' . $this->judul . '"';					
                    $btnDelete = ($row->POSTED == 1) ? ' onclick= "alert(\'Transaksi ' . $row->NO_BUKTI . ' sudah diposting!\')" href="#" ' : ' href="bank/delete/' . $row->NO_ID . '/?flagz=' . $row->TYPE . '&bacnoz=' . $row->BACNO . '" ';


                    $btnPrivilege =
                        '
                                <a class="dropdown-item" ' . $btnEdit . '>
                                <i class="fas fa-edit"></i>
                                    Edit
                                </a>
                                <a class="dropdown-item btn btn-danger" href="bank/print/' . $row->NO_ID . '">
                                    <i class="fa fa-print" aria-hidden="true"></i>
                                    Print
                                </a>
                                <a class="dropdown-item btn btn-danger" href="bank/print2/' . $row->NO_ID . '">
                                    <i class="fa fa-print" aria-hidden="true"></i>
                                    Print Tanpa Bukti
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


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
                'NO_BUKTI'       => 'required',
                'TGL'      => 'required',
                'BACNO'       => 'required'

            ]
        );
		
		$this->setFlag($request);
        $FLAGZ = $this->FLAGZ;
        $judul = $this->judul;
        $BACNOZ = $this->BACNOZ;	
		
		$query1 = DB::table('account')->select('*')->where('ACNO', $this->BACNOZ)->limit(1)->get();
		
		$KD1 = '';
		$BNAMA1 = '';
		
        if ($query1 != '[]') {
            $KD1 = $query1[0]->KD;
			$BNAMA1 = $query1[0]->NAMA;

		}
			
        //////     nomer otomatis

        $periode = $request->session()->get('periode')['bulan'] . '/' . $request->session()->get('periode')['tahun'];

        $bulan    = session()->get('periode')['bulan'];
        $tahun    = substr(session()->get('periode')['tahun'], -2);
        $query = DB::table('bank')->select('NO_BUKTI')->where('PER', $periode)->where('TYPE', $this->FLAGZ)->where('BACNO', $this->BACNOZ )->orderByDesc('NO_BUKTI')->limit(1)->get();

        if ($query != '[]') {
            $query = substr($query[0]->NO_BUKTI, -4);
            $query = str_pad($query + 1, 4, 0, STR_PAD_LEFT);
            $no_bukti = $this->FLAGZ . $KD1 . $tahun . $bulan . '-' . $query;
        } else {
            $no_bukti = $this->FLAGZ . $KD1 . $tahun . $bulan . '-0001';
        }



        // Insert Header

        // ganti 10

        $bank = Bank::create(
            [
                'NO_BUKTI'         => $no_bukti,
                'TGL'              => date('Y-m-d', strtotime($request['TGL'])),
                'PER'              => $periode,
                'BACNO'            => ($request['BACNO'] == null) ? "" : $request['BACNO'],
                'BNAMA'            => ($request['BNAMA'] == null) ? "" : $request['BNAMA'],
            //    'BG'               => ($request['BG'] == null) ? "" : $request['BG'],
            //    'JTEMPO'           => date('Y-m-d', strtotime($request['JTEMPO'])),
                'KET'              => ($request['KET'] == null) ? "" : $request['KET'],
                'FLAG'             => 'B',
                'TYPE'             => $FLAGZ,
                'KD'               => $KD1,
                'BNK'              => '2',
                'JUMLAH'           => (float) str_replace(',', '', $request['TJUMLAH']),
                'USRNM_KSR'            => Auth::user()->username,
                'created_by'       => Auth::user()->username,
                'TG_SMP_KSR'           => Carbon::now()
            ]
        );

        // Insert Detail
        $REC    = $request->input('REC');
        $ACNO    = $request->input('ACNO');
        $NAMA    = $request->input('NAMA');
        $NO_HUT    = $request->input('NO_HUT');
        $URAIAN    = $request->input('URAIAN');
        $JUMLAH    = $request->input('JUMLAH');
        $TGL_CAIR    = $request->input('TGL_CAIR');
        $BG         = $request->input('BG');
        $JTEMPO    = $request->input('JTEMPO');	

        // Check jika value detail ada/tidak
        if ($REC) {
            foreach ($REC as $key => $value) {
                // Declare new data di Model
                $detail    = new BankDetail;

                // Insert ke Database
                $detail->NO_BUKTI = $no_bukti;
                $detail->REC    = $REC[$key];
                $detail->PER    = $periode;
                $detail->FLAG    = 'B';
                $detail->TYPE    = $this->FLAGZ;
                $detail->ACNO    = ($ACNO[$key] == null) ? "" :  $ACNO[$key];
                $detail->NAMA    = ($NAMA[$key] == null) ? "" :  $NAMA[$key];
                $detail->NO_HUT    = ($NO_HUT[$key] == null) ? "" :  $NO_HUT[$key];
                $detail->URAIAN    = ($URAIAN[$key] == null) ? "" :  $URAIAN[$key];
                $detail->JUMLAH    = (float) str_replace(',', '', $JUMLAH[$key]);
                $detail->DEBET    = (float) str_replace(',', '', $JUMLAH[$key]);
				$detail->KREDIT    = (float) str_replace(',', '', $JUMLAH[$key]);
                $detail->TGL_CAIR   = date('Y-m-d', strtotime($TGL_CAIR[$key]));
                $detail->BG         = ($BG[$key] == null) ? "" :  $BG[$key];
                $detail->JTEMPO     = date('Y-m-d', strtotime($JTEMPO[$key]));	
                $detail->save();
            }
        }

        //  ganti 11
        $variablell = DB::select('call bankins(?)', array($no_bukti));

	    $no_buktix = $no_bukti;
		
		$bank = Bank::where('NO_BUKTI', $no_buktix )->first();
					 
        return redirect('/bank/edit/?idx=' . $bank->NO_ID . '&tipx=edit&flagz=' . $this->FLAGZ . '&bacnoz=' . $this->BACNOZ  . '&judul=' . $this->judul . '');
		
    }


    // ganti 15

    public function edit( Request $request , Bank $bank)
    {

		$per = session()->get('periode')['bulan'] . '/' . session()->get('periode')['tahun'];
        $cekperid = DB::SELECT("SELECT POSTED from perid WHERE PERIO='$per'");
        if ($cekperid[0]->POSTED==1)
        {
            return redirect('/bank')->with('status', 'Maaf Periode sudah ditutup!');
        }
		
		$this->setFlag($request);
		
	    $tipx = $request->tipx;

		$idx = $request->idx;
					

		
		if ( $idx =='0' && $tipx=='undo'  )
	    {
			$tipx ='top';
			
		   }
		   
		   
		
		if ($tipx=='top') {
			
		   	
		   $bingco = DB::SELECT("SELECT NO_ID, NO_BUKTI from BANK 
		                 where PER ='$per' and TYPE ='$this->FLAGZ'     
		                 ORDER BY NO_BUKTI ASC  LIMIT 1" );
						 
					
		
			if(!empty($bingco)) 
			{
				$idx = $bingco[0]->NO_ID;
			  }
			else
			{
				$idx = 0; 
			  }
		
					
		}
		
		
		if ($tipx=='prev' ) {
			
    	   $buktix = $request->buktix;
			
		   $bingco = DB::SELECT("SELECT NO_ID, NO_BUKTI from BANK      
		             where PER ='$per' and TYPE ='$this->FLAGZ' and NO_BUKTI < 
					 '$buktix' ORDER BY NO_BUKTI DESC LIMIT 1" );
			

			if(!empty($bingco)) 
			{
				$idx = $bingco[0]->NO_ID;
			  }
			else
			{
				$idx = $idx; 
			  }
			  
		}
		
		
		if ($tipx=='next' ) {
			
				
      	   $buktix = $request->buktix;
	   
		   $bingco = DB::SELECT("SELECT NO_ID, NO_BUKTI from BANK    
		             where PER ='$per' and TYPE ='$this->FLAGZ' and NO_BUKTI > 
					 '$buktix' ORDER BY NO_BUKTI ASC LIMIT 1" );
					 
			if(!empty($bingco)) 
			{
				$idx = $bingco[0]->NO_ID;
			  }
			else
			{
				$idx = $idx; 
			  }
			  
			
		}

		if ($tipx=='bottom') {
		  
    		$bingco = DB::SELECT("SELECT NO_ID, NO_BUKTI from Bank
            		  where PER ='$per' and TYPE ='$this->FLAGZ'   
		              ORDER BY NO_BUKTI DESC  LIMIT 1" );
					 
			if(!empty($bingco)) 
			{
				$idx = $bingco[0]->NO_ID;
			  }
			else
			{
				$idx = 0; 
			  }
			  
			
		}

        
		if ( $tipx=='undo'  )
	    {
        
			$tipx ='edit';
			
		   }

			
		
       	if ( $idx != 0 ) 
		{
			$bank = Bank::where('NO_ID', $idx )->first();	
	     }
		 else
		 {
				$query1 = DB::table('account')->select('*')->where('ACNO', $this->BACNOZ)->limit(1)->get();
		
				$KD1 = '';
				$BNAMA1 = '';
		
				if ($query1 != '[]') {
					$KD1 = $query1[0]->KD;
					$BNAMA1 = $query1[0]->NAMA;

				}
		
				$bank = new Bank;
                $bank->TGL = Carbon::now();
                $bank->BACNO = $this->BACNOZ;
                $bank->BNAMA = $BNAMA1;				
				
		 }

 
		
        $no_bukti = $bank->NO_BUKTI;
				
        $bankDetail = DB::table('bankd')->where('NO_BUKTI', $no_bukti)->get();
        $data = [
            'header'        => $bank,
            'detail'        => $bankDetail
        ];
		
		$periode = $request->session()->get('periode')['bulan'] . '/' . $request->session()->get('periode')['tahun'];
		
		$query = DB::table('bank')->select('NO_BUKTI')->where('PER', $periode)->where('TYPE', $this->FLAGZ)->where('BACNO', $this->BACNOZ )->orderByDesc('NO_BUKTI')->limit(1)->get();
		
		
		$xbukti = '';
        // Check apakah No Bukti terakhir NULL
        if ($query != '[]') {
            $xbukti = $query[0]->NO_BUKTI;
        } else {
            $xbukti ='';
        }
         
        return view('ftransaksi_bank.edit', $data)
        ->with(['tipx' => $tipx, 'idx' => $idx, 'flagz' =>$this->FLAGZ, 'bacnoz' =>$this->BACNOZ, 'xbukti' =>$xbukti, 'judul', $this->judul ]);
	
    
	} 
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Master\Rute  $rute
     * @return \Illuminate\Http\Response
     */

    // ganti 18
    public function update(Request $request, Bank $bank)
    {

        $this->validate(
            $request,
            [

                // ganti 19

                'TGL'      => 'required',
                'BACNO'       => 'required'
            ]
        );

        // ganti 20
        $variablell = DB::select('call bankdel(?)', array($bank['NO_BUKTI']));

	
		$this->setFlag($request);
        $FLAGZ = $this->FLAGZ;
        $BACNOZ = $this->BACNOZ;
        $judul = $this->judul;	
		
        $periode = $request->session()->get('periode')['bulan'] . '/' . $request->session()->get('periode')['tahun'];


        $bank->update(
            [

                'TGL'              => date('Y-m-d', strtotime($request['TGL'])),
                'BACNO'            => ($request['BACNO'] == null) ? "" : $request['BACNO'],
                'BNAMA'            => ($request['BNAMA'] == null) ? "" : $request['BNAMA'],
            //    'BG'               => ($request['BG'] == null) ? "" : $request['BG'],
            //    'JTEMPO'           => date('Y-m-d', strtotime($request['JTEMPO'])),
                'KET'              => ($request['KET'] == null) ? "" : $request['KET'],
                'JUMLAH'           => (float) str_replace(',', '', $request['TJUMLAH']),
                'USRNM_KSR'            => Auth::user()->username,
                'updated_by'       => Auth::user()->username,
                'TG_SMP_KSR'           => Carbon::now()
            ]
        );

		$no_buktix = $bank->NO_BUKTI;
		
        // Update Detail
        $length = sizeof($request->input('REC'));
        $NO_ID  = $request->input('NO_ID');

        $REC    = $request->input('REC');
        $ACNO   = $request->input('ACNO');
        $NAMA  = $request->input('NAMA');
        $NO_HUT    = $request->input('NO_HUT');
        $URAIAN = $request->input('URAIAN');
        $JUMLAH = $request->input('JUMLAH');
        $TGL_CAIR  = $request->input('TGL_CAIR');
        $BG        = $request->input('BG');
        $JTEMPO    = $request->input('JTEMPO');	

        // Delete yang NO_ID tidak ada di input
        $query = DB::table('bankd')->where('NO_BUKTI', $request->NO_BUKTI)->whereNotIn('NO_ID',  $NO_ID)->delete();

        // Update / Insert
        for ($i = 0; $i < $length; $i++) {
            // Insert jika NO_ID baru
            if ($NO_ID[$i] == 'new') {
                $insert = BankDetail::create(
                    [
                        'NO_BUKTI'   => $no_buktix,
                        'REC'        => $REC[$i],
                        'PER'        => $periode,
                        'FLAG'       => 'B',
                        'TYPE'       => $FLAGZ,
                        'ACNO'       => ($ACNO[$i] == null) ? "" :  $ACNO[$i],
                        'NAMA'      => ($NAMA[$i] == null) ? "" : $NAMA[$i],
                        'NO_HUT'     => ($NO_HUT[$i] == null) ? "" : $NO_HUT[$i],
                        'URAIAN'     => ($URAIAN[$i] == null) ? "" : $URAIAN[$i],
                        'JUMLAH'     => (float) str_replace(',', '', $JUMLAH[$i]),
                        'DEBET'      => (float) str_replace(',', '', $JUMLAH[$i]),
                        'TGL_CAIR'   => ($TGL_CAIR[$i] != '') ? date("Y-m-d", strtotime($TGL_CAIR[$i])) : "",
                        'JTEMPO'     => ($JTEMPO[$i] != '') ? date("Y-m-d", strtotime($JTEMPO[$i])) : "",
                        'BG'         => ($BG[$i] == null) ? "" : $BG[$i],
                        'KREDIT'     => (float) str_replace(',', '', $JUMLAH[$i])
                    ]
                );
            } else {
                // Update jika NO_ID sudah ada
                $update = BankDetail::updateOrCreate(
                    [
                        'NO_BUKTI'  => $no_buktix,
                        'NO_ID'     => (int) str_replace(',', '', $NO_ID[$i])
                    ],

                    [
                        'REC'        => $REC[$i],
                        'ACNO'       => ($ACNO[$i] == null) ? "" :  $ACNO[$i],
                        'NAMA'      => ($NAMA[$i] == null) ? "" : $NAMA[$i],
                        'NO_HUT'     => ($NO_HUT[$i] == null) ? "" : $NO_HUT[$i],
                        'URAIAN'     => ($URAIAN[$i] == null) ? "" : $URAIAN[$i],
                        'JUMLAH'     => (float) str_replace(',', '', $JUMLAH[$i]),
                        'DEBET'      => (float) str_replace(',', '', $JUMLAH[$i]),
                        'TGL_CAIR'   => ($TGL_CAIR[$i] != '') ? date("Y-m-d", strtotime($TGL_CAIR[$i])) : "",
                        'JTEMPO'     => ($JTEMPO[$i] != '') ? date("Y-m-d", strtotime($JTEMPO[$i])) : "",
                        'BG'         => ($BG[$i] == null) ? "" : $BG[$i],
                        'KREDIT'     => (float) str_replace(',', '', $JUMLAH[$i])
                    ]
                );
            }
        }



        //  ganti 21
        $variablell = DB::select('call bankins(?)', array($bank['NO_BUKTI']));

		
		$bank = Bank::where('NO_BUKTI', $no_buktix )->first();
					 
        return redirect('/bank/edit/?idx=' . $bank->NO_ID . '&tipx=edit&flagz=' . $this->FLAGZ . '&bacnoz=' . $this->BACNOZ . '&judul=' . $this->judul . '');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Master\Rute  $rute
     * @return \Illuminate\Http\Response
     */

    // ganti 22

    public function destroy( Request $request, Bank $bank)
    {


		$this->setFlag($request);
        $FLAGZ = $this->FLAGZ;
        $BACNOZ = $this->BACNOZ;
        $judul = $this->judul;
		
		
		$per = session()->get('periode')['bulan'] . '/' . session()->get('periode')['tahun'];
        $cekperid = DB::SELECT("SELECT POSTED from perid WHERE PERIO='$per'");
        if ($cekperid[0]->POSTED==1)
        {
            return redirect('/bank')
				->with('status', 'Maaf Periode sudah ditutup!')
                ->with(['judul' => $judul, 'bacnoz' => $BACNOZ, 'flagz' => $FLAGZ]);
        }
		
        $variablell = DB::select('call bankdel(?)', array($bank['NO_BUKTI']));


        // ganti 23
        $deleteBank = Bank::find($bank->NO_ID);
        $deleteBeli->delete();

        // ganti 24

        $deleteBank->delete();

        // ganti 
		return redirect('/bank?flagz='.$FLAGZ.'&bacnoz='.$BACNOZ)->with(['judul' => $judul,  'bacnoz' => $BACNOZ, 'flagz' => $FLAGZ ])->with('statusHapus', 'Data '.$bank->NO_BUKTI.' berhasil dihapus');


    }

    public function cetak(Bank $bank, Request $request)
    {
        $this->setFlag($request);
        $FLAGZ = $this->FLAGZ;
        $judul = $this->judul;
		
        $no_bukti = $bank->NO_BUKTI;
        $TJUMLAH = $bank->JUMLAH;

        $file     = 'Transaksi_Bank_Bank';
        $PHPJasperXML = new PHPJasperXML();
        $PHPJasperXML->load_xml_file(base_path() . ('/app/reportc01/phpjasperxml/' . $file . '.jrxml'));

        $terbilangx = ucwords($this->pembilang($TJUMLAH));
        $PHPJasperXML->arrayParameter = array("TERBILANG" => (string) $terbilangx);
		
		$queryakum = DB::SELECT("SET @akum:=0;");
		$query = DB::SELECT(

			"SELECT bank.NO_BUKTI AS NO_BUKTI, 
					RIGHT(bank.NO_BUKTI, 4) AS NO_BUKTI_BELAKANG, 
					if ( bank.TYPE='BBM' , 'BANK MASUK', 'BANK KELUAR' ) as judul,
					DATE_FORMAT(bank.TGL,'%d/%m/%Y') AS TGL,
					bank.KET AS KET, 
					bank.JUMLAH AS TJUMLAH, 

					bankd.REC AS REC,
					bankd.ACNO AS ACNO,
					bankd.URAIAN AS URAIAN,
					bankd.JUMLAH AS JUMLAH
				FROM bank, bankd 
				WHERE bank.NO_BUKTI='" . $no_bukti . "' 
				AND bank.NO_BUKTI = bankd.NO_BUKTI
				ORDER BY bankd.REC"
			);

        $data = [];
        foreach ($query as $key => $value) {
            array_push($data, array(

                'NO_BUKTI' => $query[$key]->NO_BUKTI,
                'NO_BUKTI_BELAKANG' => $query[$key]->NO_BUKTI_BELAKANG,
                'TGL' => $query[$key]->TGL,
                'KET' => $query[$key]->KET,
                'TJUMLAH' => $query[$key]->TJUMLAH,
                'REC' => $query[$key]->REC,
                'ACNO' => $query[$key]->ACNO,
                'URAIAN' => $query[$key]->URAIAN,
                'JUMLAH' => $query[$key]->JUMLAH,
                'JUDUL' => $query[$key]->judul,
                // 'JUMLAH_TERBILANG' => number_to_words($query[$key]->TJUMLAH),
				//'JUMLAH_TERBILANG' => ucwords($this->pembilang($query[$key]->TJUMLAH)),
            ));
        }
        $PHPJasperXML->setData($data);
        ob_end_clean();
        $PHPJasperXML->outpage("I");
    }

    public function cetak2(Bank $bank, Request $request)
    {
        $this->setFlag($request);
        $FLAGZ = $this->FLAGZ;
        $judul = $this->judul;
        
        $no_bukti = $bank->NO_BUKTI;
        $TJUMLAH = $bank->JUMLAH;

        $file     = 'Transaksi_Bank_Bank';
        $PHPJasperXML = new PHPJasperXML();
        $PHPJasperXML->load_xml_file(base_path() . ('/app/reportc01/phpjasperxml/' . $file . '.jrxml'));
		
        $terbilangx = ucwords($this->pembilang($TJUMLAH));
        $PHPJasperXML->arrayParameter = array("TERBILANG" => (string) $terbilangx);

		$queryakum = DB::SELECT("SET @akum:=0;");
		$query = DB::SELECT(
			"SELECT bank.NO_BUKTI AS NO_BUKTI, 
                    RIGHT(bank.NO_BUKTI, 4) AS NO_BUKTI_BELAKANG, 
					if ( bank.TYPE='BBM' , 'BANK MASUK', 'BANK KELUAR' ) as judul,
                    DATE_FORMAT(bank.TGL,'%d/%m/%Y') AS TGL,
                    bank.KET AS KET, 
                    bank.JUMLAH AS TJUMLAH, 

                    bankd.REC AS REC,
                    bankd.ACNO AS ACNO,
                    bankd.URAIAN AS URAIAN,
                    bankd.JUMLAH AS JUMLAH
                FROM bank, bankd 
                WHERE bank.NO_BUKTI='" . $no_bukti . "' 
                AND bank.NO_BUKTI = bankd.NO_BUKTI
                ORDER BY bankd.REC "
			);

        $data = [];
        foreach ($query as $key => $value) {
            array_push($data, array(

                'NO_BUKTI' => $query[$key]->NO_BUKTI,
                'NO_BUKTI_BELAKANG' => $query[$key]->NO_BUKTI_BELAKANG,
                'TGL' => $query[$key]->TGL,
                'KET' => $query[$key]->KET,
                'TJUMLAH' => $query[$key]->TJUMLAH,
                'REC' => $query[$key]->REC,
                'ACNO' => $query[$key]->ACNO,
                'URAIAN' => $query[$key]->URAIAN,
                'JUMLAH' => $query[$key]->JUMLAH,
                'JUDUL' => $query[$key]->judul,
                // 'JUMLAH_TERBILANG' => number_to_words($query[$key]->TJUMLAH),
				//'JUMLAH_TERBILANG' => ucwords($this->pembilang($query[$key]->TJUMLAH)),
            ));
        }
        $PHPJasperXML->setData($data);
        ob_end_clean();
        $PHPJasperXML->outpage("I");
    }
	
	
	 public function cek_bukti(Request $request)
    {
        $getItem = DB::SELECT('select count(*) as ADA from bank where NO_BUKTI ="' . $request->NO_BUKTI . '"');

        return $getItem;
    }
	
	
	
	
	
}
