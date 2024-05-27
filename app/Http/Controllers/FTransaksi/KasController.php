<?php

namespace App\Http\Controllers\FTransaksi;

use App\Http\Controllers\Controller;
use App\Http\Traits\Terbilang;
// ganti 1

use App\Models\FTransaksi\Kas;
use App\Models\FTransaksi\KasDetail;
use Illuminate\Http\Request;
use DataTables;
use Auth;
use DB;
use Carbon\Carbon;


include_once base_path() . "/vendor/simitgroup/phpjasperxml/version/1.1/PHPJasperXML.inc.php";

use PHPJasperXML;




// ganti 2
class KasController extends Controller
{
	use Terbilang;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	 
    var $judul = '';
    var $FLAGZ = '';
    var $XBUKTI ='';


    function setFlag(Request $request)
    {
        if ( $request->flagz == 'BKK' ) {
            $this->judul = "Kas Keluar";
        } else if ( $request->flagz == 'BKM' ) {
            $this->judul = "Kas Masuk";
        }
		
        $this->FLAGZ = $request->flagz;
        $this->XBUKTI = $request->xbukti;

    }	 
	 
	 
	 
    public function index(Request $request)
    {

        // ganti 3
        $this->setFlag($request);
        // ganti 3
        return view('ftransaksi_kas.index')->with(['judul' => $this->judul, 'flagz' => $this->FLAGZ ]);
    }
	
	public function browsebkk1(Request $request)
    {
        $WILX = $request['WILX'] ;
        $kask = DB::SELECT("SELECT NO_BUKTI FROM PEMASARANKAS where pemasarankas.WILAYAH='$WILX' AND pemasarankas.NO_KASIR='' ORDER BY NO_BUKTI");
	
        return response()->json($kask);
    }
	
	public function browsebkk2()
    {	
		
        $kask = DB::SELECT("SELECT NO_BUKTI FROM PEMASARANKAS ORDER BY NO_BUKTI");
	
        return response()->json($kask);
    }
	
	public function browse_kas_pms(Request $request )
    {
        $statx = $request['STATX'];
		$no_bukti_1 = $request['BUKTIX'] ; 
		$no_bukti_2 = $request['BUKTIY'] ;
		$wilayah = $request['WILX'] ;
    
		$tgl_baru = date("Y-m-d", strtotime($request['TGL_AMBIL']));
		$no_kasir_1 = "";
		$no_kasir_2 = "";

        $q1= "CALL kasir_transaksi_databkk('','$no_bukti_1','$no_bukti_2','$wilayah','', '','')";

        if($statx=='isi'){
			$no_kasir_1 = $request['nokasir1'];
			$no_kasir_2 = $request['nokasir2'];

            $q1 = " CALL kasir_transaksi_databkk('ISI','$no_bukti_1','$no_bukti_2','$wilayah','$tgl_baru', '$no_kasir_1','".Auth::user()->username."')";
        }

        $kask = DB::SELECT($q1);
        return response()->json($kask);
    }

    // ganti 4


    public function browse_bukti(Request $request)
    {
        $NO_BUKTI = $request->NO_BUKTI;

        $kel = DB::SELECT("SELECT KAS.NO_ID AS NO_IDHX, KAS.NO_BUKTI, KAS.TGL, KAS.BACNO, KAS.BNAMA, KAS.KET, KAS.JUMLAH AS TJUMLAH,
		                   KASD.REC, KASD.NO_ID, KASD.ACNO, KASD.NAMA, KASD.URAIAN, KASD.JUMLAH, KASD.VAL FROM 
						   KAS, KASD WHERE KAS.NO_BUKTI = KASD.NO_BUKTI and KASD.VAL = 0 
						   AND KAS.NO_BUKTI ='$NO_BUKTI' ");
       
		return response()->json($kel);
    }


    public function cari(Request $request)
    {
        

		$type01 = $request['flagz'];
			
        if ($request->session()->has('periode')) {
            $periode = $request->session()->get('periode')['bulan'] . '/' . $request->session()->get('periode')['tahun'];
        } else {
            $periode = '';
        }

        $this->setFlag($request);
		
        $kel = DB::SELECT("SELECT KAS.NO_BUKTI, DATE_FORMAT(KAS.TGL,'%d/%m/%Y') AS TGL, KASD.ACNO, KASD.NACNO, KASD.URAIAN, KASD.NO_HUT,  KASD.JUMLAH FROM 
						   KAS, KASD WHERE KAS.NO_BUKTI = KASD.NO_BUKTI  AND LEFT(KAS.NO_BUKTI,3)='$type01' AND  KAS.PER = '$periode'  ");
 
 
 
		return response()->json($kel);
    }
	
    public function getKas(Request $request)
    {
        // ganti 5


        if ($request->session()->has('periode')) {
            $periode = $request->session()->get('periode')['bulan'] . '/' . $request->session()->get('periode')['tahun'];
        } else {
            $periode = '';
        }

        $this->setFlag($request);
		
        $kas = DB::SELECT("SELECT * from kas where  PER ='$periode' and TYPE ='$this->FLAGZ'  ORDER BY NO_BUKTI ");
	  
        // ganti 6

        return Datatables::of($kas)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                if (Auth::user()->divisi=="programmer" || Auth::user()->divisi=="owner" || Auth::user()->divisi=="assistant" || Auth::user()->divisi=="accounting") 
                {
                    $btnPrivilege =


                    $btnEdit =   ($row->POSTED == 1) ? ' onclick= "alert(\'Transaksi ' . $row->NO_BUKTI . ' sudah diposting!\')" href="#" ' : ' href="kas/edit/?idx=' . $row->NO_ID . '&tipx=edit&flagz=' . $row->TYPE . '&judul=' . $this->judul . '"';					
                    $btnDelete = ($row->POSTED == 1) ? ' onclick= "alert(\'Transaksi ' . $row->NO_BUKTI . ' sudah diposting!\')" href="#" ' : ' href="kas/delete/' . $row->NO_ID . '/?flagz=' . $row->TYPE  . '" ';


                    $btnPrivilege =
                        '
                                <a class="dropdown-item" ' . $btnEdit . '>
                                <i class="fas fa-edit"></i>
                                    Edit
                                </a>
                                <a class="dropdown-item btn btn-danger" href="kas/print/' . $row->NO_ID . '">
                                    <i class="fa fa-print" aria-hidden="true"></i>
                                    Print
                                </a>
                                <a class="dropdown-item btn btn-danger" href="kas/print2/' . $row->NO_ID . '">
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


	 
	public function createdatabkk()
    {
		$per = session()->get('periode')['bulan'] . '/' . session()->get('periode')['tahun'];		
        return view('ftransaksi_kas.createdatabkk');
    }

	 
    public function storedatabkk(Request $request)
    {
		$statx = '';
		$wilayah = $request['WILAYAH'];
		$no_bukti_1 = $request['nobukti1'];
		$no_bukti_2 = $request['nobukti2'];
		$tgl_baru = date("Y-m-d", strtotime($request['TGL_AMBIL']));
		$no_kasir_1 = "";
		$no_kasir_2 = "";


        if($request->has('proses')){
			$no_kasir_1 = $request['nokasir1'];
			$no_kasir_2 = $request['nokasir2'];
			$statx = "PROSES";
        }

		$q1 = " CALL kasir_transaksi_databkk('$statx','$no_bukti_1','$no_bukti_2','$wilayah','$tgl_baru', '$no_kasir_1','".Auth::user()->username."')";
        $kask = DB::SELECT($q1);
        
        return redirect('/kas/createdatabkk')->with('status', 'Data BKK berhasil ditambahkan');
    } 
	 
	 
    public function store(Request $request, Kas $kas )
    {

		
        $this->validate(
            $request,
            // GANTI 9

            [
                'NO_BUKTI'     => 'required',
                'TGL'          => 'required',
                'BACNO'        => 'required'

            ]
        );

        //////     nomer otomatis

		
		$this->setFlag($request);
        $FLAGZ = $this->FLAGZ;
        $judul = $this->judul;	
		
        $periode = $request->session()->get('periode')['bulan'] . '/' . $request->session()->get('periode')['tahun'];

        $bulan    = session()->get('periode')['bulan'];
        $tahun    = substr(session()->get('periode')['tahun'], -2);
        $query = DB::table('kas')->select('NO_BUKTI')->where('PER', $periode)->where('TYPE', $this->FLAGZ)->orderByDesc('NO_BUKTI')->limit(1)->get();


        $no_bukti = $request->input('NO_BUKTI');
		
		if ( $no_bukti == '+' )
	    {		
        // Check apakah No Bukti terakhir NULL
           if ($query != '[]') {
               $query = substr($query[0]->NO_BUKTI, -4);
               $query = str_pad($query + 1, 4, 0, STR_PAD_LEFT);
               $no_bukti = $this->FLAGZ . $tahun . $bulan . '-' . $query;
           } else {
               $no_bukti = $this->FLAGZ . $tahun . $bulan . '-0001';
           }
		
		}




        // Insert Header

        // ganti 10
  
        $kas = Kas::create(
            [
                'NO_BUKTI'         => $no_bukti,
                'TGL'              => date('Y-m-d', strtotime($request['TGL'])),
                'PER'              => $periode,
                'BACNO'            => ($request['BACNO'] == null) ? "" : $request['BACNO'],
                'BNAMA'            => ($request['BNAMA'] == null) ? "" : $request['BNAMA'],
                'FLAG'             => 'K',
                'TYPE'             => $FLAGZ,
                'BNK'              => '1',
                'KET'              => ($request['KET'] == null) ? "" : $request['KET'],
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
        $URAIAN    = $request->input('URAIAN');
        $NO_HUT    = $request->input('NO_HUT');
        $JUMLAH    = $request->input('JUMLAH');

        // Check jika value detail ada/tidak
        if ($REC) {
            foreach ($REC as $key => $value) {
                // Declare new data di Model
                $detail    = new KasDetail;

                // Insert ke Database
                $detail->NO_BUKTI = $no_bukti;
                $detail->REC    = $REC[$key];
                $detail->PER    = $periode;
                $detail->FLAG    = 'K';
                $detail->TYPE    = $FLAGZ;
                $detail->ACNO    = ($ACNO[$key] == null) ? "" :  $ACNO[$key];
                $detail->NAMA    = ($NAMA[$key] == null) ? "" :  $NAMA[$key];
                $detail->URAIAN    = ($URAIAN[$key] == null) ? "" :  $URAIAN[$key];
                $detail->NO_HUT    = ($NO_HUT[$key] == null) ? "" :  $NO_HUT[$key];
                $detail->JUMLAH    = (float) str_replace(',', '', $JUMLAH[$key]);
                $detail->DEBET    = (float) str_replace(',', '', $JUMLAH[$key]);
                $detail->save();
            }
        }

        //  ganti 11

        $variablell = DB::select('call kasins(?)', array($no_bukti));
		
	    $no_buktix = $no_bukti;
		
		$kas = Kas::where('NO_BUKTI', $no_buktix )->first();
					 
        return redirect('/kas/edit/?idx=' . $kas->NO_ID . '&tipx=edit&flagz=' . $this->FLAGZ . '&judul=' . $this->judul . '');

	
    }


    // ganti 15

    public function edit( Request $request , Kas $kas)
    {


		$per = session()->get('periode')['bulan'] . '/' . session()->get('periode')['tahun'];
		
				
        $cekperid = DB::SELECT("SELECT POSTED from perid WHERE PERIO='$per'");
        if ($cekperid[0]->POSTED==1)
        {
            return redirect('/kas')
			       ->with('status', 'Maaf Periode sudah ditutup!')
                   ->with(['judul' => $judul, 'flagz' => $FLAGZ]);
        }
		
		$this->setFlag($request);
		
        $tipx = $request->tipx;

		$idx = $request->idx;
			

		
		if ( $idx =='0' && $tipx=='undo'  )
	    {
			$tipx ='top';
			
		   }
		   
		 
		   
		if ($tipx=='search') {
			
		   	
    	   $buktix = $request->buktix;
		   
		   $bingco = DB::SELECT("SELECT NO_ID, NO_BUKTI from kas 
		                 where PER ='$per' and TYPE ='$this->FLAGZ' 
						 and NO_BUKTI = '$buktix'						 
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
		
		if ($tipx=='top') {
			

		   $bingco = DB::SELECT("SELECT NO_ID, NO_BUKTI from kas 
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
			
		   $bingco = DB::SELECT("SELECT NO_ID, NO_BUKTI from KAS      
		             where PER ='$per' and TYPE ='$this->FLAGZ'  and NO_BUKTI < 
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
	   
		   $bingco = DB::SELECT("SELECT NO_ID, NO_BUKTI from KAS    
		             where PER ='$per' and TYPE ='$this->FLAGZ'  and NO_BUKTI > 
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
		  
    		$bingco = DB::SELECT("SELECT NO_ID, NO_BUKTI from KAS  where PER ='$per'
            			and TYPE ='$this->FLAGZ'    
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

        
		if ( $tipx=='undo' || $tipx=='search' )
	    {
        
			$tipx ='edit';
			
		   }
		
		

       	if ( $idx != 0 ) 
		{
			$kas = Kas::where('NO_ID', $idx )->first();	
	     }
		 else
		 {
				$kas = new Kas;
                $kas->TGL = Carbon::now();
      
				
		 }

        $no_bukti = $kas->NO_BUKTI;
				
        $kasDetail = DB::table('kasd')->where('NO_BUKTI', $no_bukti)->get();
        $data = [
            'header'        => $kas,
            'detail'        => $kasDetail
        ];
        
        $periode = $request->session()->get('periode')['bulan'] . '/' . $request->session()->get('periode')['tahun'];
        
        $query = DB::table('kas')->select('NO_BUKTI')->where('PER', $periode)->where('TYPE', $this->FLAGZ)->orderByDesc('NO_BUKTI')->limit(1)->get();
		
		
		$xbukti = '';
        // Check apakah No Bukti terakhir NULL
        if ($query != '[]') {
            $xbukti = $query[0]->NO_BUKTI;
        } else {
            $xbukti ='';
        }


         return view('ftransaksi_kas.edit', $data)
		 ->with(['tipx' => $tipx, 'idx' => $idx, 'flagz' =>$this->FLAGZ, 'xbukti' =>$xbukti, 'judul', $this->judul ]);
			 
    
      
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Master\Rute  $rute
     * @return \Illuminate\Http\Response
     */

    // ganti 18

    public function update(Request $request, Kas $kas)
    {
        // return $request;
        $this->validate(
            $request,
            [
                // ganti 19
                'TGL'       => 'required',
                'BACNO'     => 'required'
            ]
        );

        // ganti 20
		
		
        $variablell = DB::select('call kasdel(?)', array($kas['NO_BUKTI']));
    
		
		$this->setFlag($request);
        $FLAGZ = $this->FLAGZ;
        $judul = $this->judul;	
		
        $periode = $request->session()->get('periode')['bulan'] . '/' . $request->session()->get('periode')['tahun'];

      
	  
        $kas->update(
            [

                'TGL'              => date('Y-m-d', strtotime($request['TGL'])),
                'BACNO'            => ($request['BACNO'] == null) ? "" : $request['BACNO'],
                'BNAMA'            => ($request['BNAMA'] == null) ? "" : $request['BNAMA'],
                'JUMLAH'           => (float) str_replace(',', '', $request['TJUMLAH']),
                'KET'              => ($request['KET'] == null) ? "" : $request['KET'],
                'USRNM_KSR'            => Auth::user()->username,
                'updated_by'       => Auth::user()->username,
                'TG_SMP_KSR'           => Carbon::now()

            ]
        );

		$no_buktix = $kas->NO_BUKTI;
		
		
        // Update Detail
        $length = sizeof($request->input('REC'));
		$NO_ID  = $request->input('NO_ID');
		$REC    = $request->input('REC');
        $ACNO    = $request->input('ACNO');
        $NAMA    = $request->input('NAMA');
        $URAIAN    = $request->input('URAIAN');
        $NO_HUT    = $request->input('NO_HUT');
        $JUMLAH    = $request->input('JUMLAH');




        // Delete yang NO_ID tidak ada di input
        $query = DB::table('kasd')->where('NO_BUKTI', $request->NO_BUKTI)->whereNotIn('NO_ID',  $NO_ID)->delete();

        
        // Update / Insert
        for ($i = 0; $i < $length; $i++) {
            // Insert jika NO_ID baru
            if ($NO_ID[$i] == 'new') {
                $insert = KasDetail::create(
                    [
                        'NO_BUKTI'   => $no_buktix,
                        'REC'        => $REC[$i],
                        'PER'        => $periode,
                        'FLAG'       => 'K',
                        'TYPE'       =>  $FLAGZ,
                        'ACNO'       => ($ACNO[$i] == null) ? "" :  $ACNO[$i],
                        'NAMA'      =>  ($NAMA[$i] == null) ? "" : $NAMA[$i],
                        'URAIAN'     => ($URAIAN[$i] == null) ? "" : $URAIAN[$i],
                        'NO_HUT'     => ($NO_HUT[$i] == null) ? "" : $NO_HUT[$i],
                        'JUMLAH'     => (float) str_replace(',', '', $JUMLAH[$i]),
                        'DEBET'      => (float) str_replace(',', '', $JUMLAH[$i]),
					
						
						
						

                    ]
                );
            } else {
                // Update jika NO_ID sudah ada
                $update = KasDetail::updateOrCreate(
                    [
                        'NO_BUKTI'  => $no_buktix,
                        'NO_ID'     => (int) str_replace(',', '', $NO_ID[$i])
                    ],

                    [
                        'REC'        => $REC[$i],
                        'ACNO'       => ($ACNO[$i] == null) ? "" :  $ACNO[$i],
                        'NAMA'      =>  ($NAMA[$i] == null) ? "" : $NAMA[$i],
                        'URAIAN'     => ($URAIAN[$i] == null) ? "" : $URAIAN[$i],
                        'NO_HUT'     => ($NO_HUT[$i] == null) ? "" : $NO_HUT[$i],
                        'JUMLAH'     => (float) str_replace(',', '', $JUMLAH[$i]),
                        'DEBET'      => (float) str_replace(',', '', $JUMLAH[$i]),

                    ]
                );
            }
        }

 
        // ganti 21
        $variablell = DB::select('call kasins(?)', array($kas['NO_BUKTI']));
		
		$kas = Kas::where('NO_BUKTI', $no_buktix )->first();
					 
        return redirect('/kas/edit/?idx=' . $kas->NO_ID . '&tipx=edit&flagz=' . $this->FLAGZ . '&judul=' . $this->judul . '');			
 
	}


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Master\Rute  $rute
     * @return \Illuminate\Http\Response
     */

    // ganti 22

    public function destroy( Request $request, Kas $kas)
    {
        
		$this->setFlag($request);
        $FLAGZ = $this->FLAGZ;
        $judul = $this->judul;
		
		$per = session()->get('periode')['bulan'] . '/' . session()->get('periode')['tahun'];
        $cekperid = DB::SELECT("SELECT POSTED from perid WHERE PERIO='$per'");
        if ($cekperid[0]->POSTED==1)
        {
            return redirect()->route('kas')
                ->with('status', 'Maaf Periode sudah ditutup!')
                ->with(['judul' => $judul, 'flagz' => $FLAGZ]);
        }
		
		
		
		
        $variablell = DB::select('call kasdel(?)', array($kas['NO_BUKTI']));

        // ganti 23
        $deleteKas = Kas::find($kas->NO_ID);

        // ganti 24
        $deleteKas->delete();

		 
        // ganti 
		return redirect('/kas?flagz='.$FLAGZ)->with(['judul' => $judul, 'flagz' => $FLAGZ ])->with('statusHapus', 'Data '.$kas->NO_BUKTI.' berhasil dihapus');


    }


    public function cetak(Kas $kas, Request $request)
    {
        $this->setFlag($request);
        $FLAGZ = $this->FLAGZ;
        $judul = $this->judul;

        $no_bukti = $kas->NO_BUKTI;
        $TJUMLAH = $kas->JUMLAH;
		
        $file     = 'Transaksi_Kas_Kas';
        $PHPJasperXML = new PHPJasperXML();
        $PHPJasperXML->load_xml_file(base_path() . ('/app/reportc01/phpjasperxml/' . $file . '.jrxml'));

        $terbilangx = ucwords($this->pembilang($TJUMLAH));
        $PHPJasperXML->arrayParameter = array("TERBILANG" => (string) $terbilangx);

		$queryakum = DB::SELECT("SET @akum:=0;");
		$query = DB::SELECT(

			"SELECT kas.NO_BUKTI AS NO_BUKTI, 
                    RIGHT(kas.NO_BUKTI, 4) AS NO_BUKTI_BELAKANG, 
					if ( kas.TYPE='BKM' , 'KAS MASUK', 'KAS KELUAR' ) as judul,
                    DATE_FORMAT(kas.TGL,'%d/%m/%Y') AS TGL,
                    kas.KET AS KET, 
                    kas.JUMLAH AS TJUMLAH, 
                    kasd.REC AS REC,
                    kasd.ACNO AS ACNO,
                    kasd.URAIAN AS URAIAN,
                    kasd.JUMLAH AS JUMLAH
                FROM kas, kasd 
                WHERE kas.NO_BUKTI='" . $no_bukti . "' 
                AND kas.NO_BUKTI = kasd.NO_BUKTI
                ORDER BY kasd.REC"
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

    public function cetak2(Kas $kas, Request $request)
    {
        $this->setFlag($request);
        $FLAGZ = $this->FLAGZ;
        $judul = $this->judul;

        $no_bukti = $kas->NO_BUKTI;
        $TJUMLAH = $kas->JUMLAH;
		
        $file     = 'Transaksi_Kas_Kas';
        $PHPJasperXML = new PHPJasperXML();
        $PHPJasperXML->load_xml_file(base_path() . ('/app/reportc01/phpjasperxml/' . $file . '.jrxml'));

        $terbilangx = ucwords($this->pembilang($TJUMLAH));
        $PHPJasperXML->arrayParameter = array("TERBILANG" => (string) $terbilangx);

		$queryakum = DB::SELECT("SET @akum:=0;");
		$query = DB::SELECT(
			"SELECT kas.NO_BUKTI AS NO_BUKTI, 
                '' AS NO_BUKTI_BELAKANG, 
                DATE_FORMAT(kas.TGL,'%d/%m/%Y') AS TGL,
                kas.KET AS KET, 
                kas.JUMLAH AS TJUMLAH, 

                kasd.REC AS REC,
                kasd.ACNO AS ACNO,
                kasd.URAIAN AS URAIAN,
                kasd.JUMLAH AS JUMLAH
            FROM kas, kasd 
            WHERE kas.NO_BUKTI='" . $no_bukti . "' 
            AND kas.NO_BUKTI = kasd.NO_BUKTI
            ORDER BY kasd.REC "
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
                'JUDUL' => $judul,
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
        $getItem = DB::SELECT('select count(*) as ADA from kas where NO_BUKTI ="' . $request->NO_BUKTI . '"');

        return $getItem;
    }
		
	
}
