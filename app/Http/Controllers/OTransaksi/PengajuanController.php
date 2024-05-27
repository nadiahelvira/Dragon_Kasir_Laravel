<?php

namespace App\Http\Controllers\OTransaksi;

use App\Http\Controllers\Controller;
// ganti 1

use App\Models\OTransaksi\Pengajuan;
use App\Models\OTransaksi\PengajuanDetail;
use Illuminate\Http\Request;
use DataTables;
use Auth;
use DB;
use Carbon\Carbon;


include_once base_path() . "/vendor/simitgroup/phpjasperxml/version/1.1/PHPJasperXML.inc.php";

use PHPJasperXML;




// ganti 2
class PengajuanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	 
	var $judul = '';
	var $jenisnya = '';
	var $drnya = '';
	var $devnya = '';	
    var $FLAGZ = '';


    function setFlag(Request $request)
    {
        if ( $request->flagz == '1IJ' ) {
            $this->judul = "Borongan Dragon 1";
            $this->jenisnya = "DR1";
            $this->drnya = "1";
            $this->devnya = "IJ";
        } else if ( $request->flagz == '2CV' ) {
            $this->judul = "Borongan Vulcanized";
            $this->jenisnya = "VULC";
            $this->drnya = "2";
            $this->devnya = "CV";
        } else if ( $request->flagz == '2CM' ) {
            $this->judul = "Borongan Cementing";
            $this->jenisnya = "CMT";
            $this->drnya = "2";
            $this->devnya = "CM";
        } else if ( $request->flagz == '2IJ' ) {
            $this->judul = "Borongan Inject Dr 2";
            $this->jenisnya = "INJDR2";
            $this->drnya = "2";
            $this->devnya = "IJ";
        } else if ( $request->flagz == '3IJ' ) {
            $this->judul = "Borongan Dragon 3";
            $this->jenisnya = "DR3";
            $this->drnya = "3";
            $this->devnya = "IJ";
        } else if ( $request->flagz == '2AB' ) {
            $this->judul = "Borongan Airblow";
            $this->jenisnya = "AIRBLOW";
            $this->drnya = "2";
            $this->devnya = "AB";
        } else if ( $request->flagz == '2PY' ) {
            $this->judul = "Borongan Phylon";
            $this->jenisnya = "PYLON";
            $this->drnya = "2";
            $this->devnya = "PY";
        }
		
        $this->FLAGZ = $request->flagz;
    
		

    }	 
	  
	 
	 
    public function index(Request $request)
    {

        // ganti 3
        $this->setFlag($request);
        // ganti 3
        return view('otransaksi_pengajuan.index')->with(['judul' => $this->judul, $this->jenisnya, $this->drnya, $this->devnya, 'flagz' => $this->FLAGZ ]);
    }

    // ganti 4

    public function getPengajuan(Request $request)
    {
        // ganti 5

        if ($request->session()->has('periode')) {
            $periode = $request->session()->get('periode')['bulan'] . '/' . $request->session()->get('periode')['tahun'];
        } else {
            $periode = '';
        }


      // $flag2 = Auth::user()->FLAG2;
	   
        //$pengajuan = DB::table('hrd_harga')->select('*')->where('PER', $periode)->orderBy('NO_BUKTI', 'ASC')->get();

        $this->setFlag($request);
		
        $pengajuan = DB::SELECT("SELECT * from hrd_harga  where  PER ='$periode' and FLAG ='$this->FLAGZ' ORDER BY NO_BUKTI ");
	   
	   
        // ganti 6

        return Datatables::of($pengajuan)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                if (Auth::user()->divisi=="programmer" ) 
                {

                    $btnEdit =   ($row->POSTED == 1) ? ' onclick= "alert(\'Transaksi ' . $row->NO_BUKTI . ' sudah diposting!\')" href="#" ' : ' href="pengajuan/edit/?idx=' . $row->ROW_ID . '&tipx=edit&flagz=' . $row->FLAG . '&judul=' . $this->judul . '"';
					
                    $btnDelete = ($row->POSTED == 1) ? ' onclick= "alert(\'Transaksi ' . $row->NO_BUKTI . ' sudah diposting!\')" href="#" ' : ' href="pengajuan/delete/' . $row->ROW_ID . '/?flagz=' . $row->FLAG . '" ';


                    $btnPrivilege =
                        '								
                                <a class="dropdown-item" ' . $btnEdit . '>
                                <i class="fas fa-edit"></i>
                                    Edit
                                </a>
                                <a class="dropdown-item btn btn-danger" href="pengajuan/jasper-pengajuan-trans/' . $row->ROW_ID . '">
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
                'NO_BUKTI'     => 'required',
                'TGL'          => 'required',

            ]
        );

        //////     nomer otomatis
		
		$this->setFlag($request);
		
		
        $FLAGZ = $this->FLAGZ;
        $judul = $this->judul;
		
	
	
        $periode = $request->session()->get('periode')['bulan'] . '/' . $request->session()->get('periode')['tahun'];

        $bulan    = session()->get('periode')['bulan'];
        $tahun    = substr(session()->get('periode')['tahun'], -2);
		$tahunx    = substr(session()->get('periode')['tahun'], -4);
        $query = DB::table('hrd_harga')->select('NO_BUKTI')->where('PER', $periode)->where('FLAG', $this->FLAGZ)->orderByDesc('NO_BUKTI')->limit(1)->get();
		
        // Check apakah No Bukti terakhir NULL
		
        if ($query != '[]') {
		   
			$query = substr($query[0]->NO_BUKTI,0, 3);
			
			
            $query = str_pad($query + 1, 3, 0, STR_PAD_LEFT);
            $no_bukti = $query . '/' . $bulan . '/' . $tahun . '/' . $this->jenisnya;
        } else {
            $no_bukti = '001' . '/' . $bulan . '/' . $tahun . '/' . $this->jenisnya;
        }





        // Insert Header

        // ganti 10

        $pengajuan = Pengajuan::create(
            [
                'NO_BUKTI'         	=> $no_bukti,
                'TGL'              	=> date('Y-m-d', strtotime($request['TGL'])),
                'PER'              	=> $periode,
                'NOTES'            	=> ($request['NOTES'] == null) ? "" : $request['NOTES'],
                'DR'            	=> $this->drnya,
                'DEV'            	=> $this->devnya,
                'FLAG'            	=> $FLAGZ,
                'USRNM'            	=> Auth::user()->username,
                'E_TGL'            	=> Carbon::now(),
                'E_PC'            	=> Auth::user()->username,
                'ttd_ie'            => ($request['ttd_ie'] == null) ? "" : $request['ttd_ie'],
                'ie_off'            => ($request['ie_off'] == null) ? "" : $request['ie_off'],
                'nm_ttd_ie'         => ($request['nm_ttd_ie'] == null) ? "" : $request['nm_ttd_ie'],
                'tg_ttd_ie'         => date('Y-m-d', strtotime($request['tg_ttd_ie'])),
                'ttd_pr'            => ($request['ttd_pr'] == null) ? "" : $request['ttd_pr'],
                'pr_off'            => ($request['pr_off'] == null) ? "" : $request['pr_off'],
                'nm_ttd_pr'         => ($request['nm_ttd_pr'] == null) ? "" : $request['nm_ttd_pr'],
                'tg_ttd_pt'         => date('Y-m-d', strtotime($request['tg_ttd_pr'])),
                'ttd_fm'            => ($request['ttd_fm'] == null) ? "" : $request['ttd_fm'],
                'fm_off'            => ($request['fm_off'] == null) ? "" : $request['fm_off'],
                'nm_ttd_fm'         => ($request['nm_ttd_fm'] == null) ? "" : $request['nm_ttd_fm'],
                'tg_ttd_fm'         => date('Y-m-d', strtotime($request['tg_ttd_fm'])),
                'ttd_hrd'           => ($request['ttd_hrd'] == null) ? "" : $request['ttd_hrd'],
                'hrd_off'           => ($request['hrd_off'] == null) ? "" : $request['hrd_off'],
                'nm_ttd_hrd'        => ($request['nm_ttd_hrd'] == null) ? "" : $request['nm_ttd_hrd'],
                'tg_ttd_hrd'        => date('Y-m-d', strtotime($request['tg_ttd_hrd'])),
                'ttd_ceo'           => ($request['ttd_ceo'] == null) ? "" : $request['ttd_ceo'],
                'ceo_off'           => ($request['ceo_off'] == null) ? "" : $request['ceo_off'],
                'nm_ttd_ceo'        => ($request['nm_ttd_ceo'] == null) ? "" : $request['nm_ttd_ceo'],
                'tg_ttd_ceo'        => date('Y-m-d', strtotime($request['tg_ttd_ceo'])),
                'print'            	=> ($request['print'] == null) ? "" : $request['print'],
                'ket1'            	=> ($request['ket1'] == null) ? "" : $request['ket1'],
                'ket2'            	=> ($request['ket2'] == null) ? "" : $request['ket2'],
                'ket3'            	=> ($request['ket3'] == null) ? "" : $request['ket3'],
                'ket4'            	=> ($request['ket4'] == null) ? "" : $request['ket4'],
                'ket5'            	=> ($request['ket5'] == null) ? "" : $request['ket5'],
                'ket6'            	=> ($request['ket6'] == null) ? "" : $request['ket6'],
                'ket7'            	=> ($request['ket7'] == null) ? "" : $request['ket7'],
                'ket8'            	=> ($request['ket8'] == null) ? "" : $request['ket8'],
                'ket9'            	=> ($request['ket9'] == null) ? "" : $request['ket9'],
                'ket10'            	=> ($request['ket10'] == null) ? "" : $request['ket10'],
				'tahun'            	=> $tahunx,
                'FLAG'             	=> $FLAGZ

            ]
        );


		$ROW_IDZ = DB::SELECT("SELECT ROW_ID from hrd_harga where NO_BUKTI='$no_bukti'");
		$ROW_IDXZZ = $ROW_IDZ[0]->ROW_ID;
		


        // Insert Detail
        $REC    = $request->input('REC');
		$ID    	= $ROW_IDXZZ;
        $NO_BUKTI    = $request->input('NO_BUKTI');	
        $PER    = $request->input('PER');
        $ARTICLE    = $request->input('ARTICLE');
        $MODE    = $request->input('MODE');
        $CUTTING    = $request->input('CUTTING');
        $cutting_t    = $request->input('cutting_t');
        $EMBOS    = $request->input('EMBOS');
        $embos_t    = $request->input('embos_t');
        $PSP    = $request->input('PSP');
        $psp_t    = $request->input('psp_t');
        $JUKI    = $request->input('JUKI');
        $juki_t    = $request->input('juki_t');
        $JAHIT    = $request->input('JAHIT');
        $jahit_t    = $request->input('jahit_t');
        $PACKING    = $request->input('PACKING');
        $packing_t    = $request->input('packing_t');
        $INJECT    = $request->input('INJECT');
        $injek    = $request->input('injek');
        $CAT_SPRAY    = $request->input('CAT_SPRAY');
        $cet_spray    = $request->input('cet_spray');
        $PSP_CAT    = $request->input('PSP_CAT');
        $psp_cet    = $request->input('cet_spray');
        $PSP_FLOCK    = $request->input('PSP_FLOCK');
        $psp_flok    = $request->input('psp_flok');
        $FLOCKING    = $request->input('FLOCKING');
        $floking    = $request->input('floking');
        $ASSB_FLOCK    = $request->input('ASSB_FLOCK');
        $ass_flok    = $request->input('cet_spray');
        $COMP    = $request->input('COMP');
        $kompon    = $request->input('kompon');
        $GILING    = $request->input('GILING');
        $geleng    = $request->input('geleng');
        $PSP_ASSB    = $request->input('PSP_ASSB');
        $psp_ass    = $request->input('psp_ass');
        $STOCKFIT    = $request->input('STOCKFIT');
        $stokfit    = $request->input('stokfit');
        $ASSEMBLING    = $request->input('ASSEMBLING');
        $ass    = $request->input('ass');
        $INJECTION    = $request->input('INJECTION');
        $injektion    = $request->input('injektion');
        $ASSB_PACKING    = $request->input('ASSB_PACKING');
        $ass_paking    = $request->input('ass_paking');
        $MICRO    = $request->input('MICRO');
        $mikro    = $request->input('mikro');
        $BORDIR    = $request->input('BORDIR');
        $gambar1    = $request->input('gambar1');
        $pdf1    = $request->input('pdf1');
        $USRNM    = $request->input('USRNM');
        $E_TGL    = $request->input('E_TGL');
        $E_PC    = $request->input('E_PC');
        $tahun    = $request->input('tahun');
        $rekharga    = $request->input('rekharga');

        // Check jika value detail ada/tidak
        if ($REC) {
            foreach ($REC as $key => $value) {
                // Declare new data di Model
                $detail    = new PengajuanDetail;

                // Insert ke Database
                $detail->NO_BUKTI = $no_bukti;
                $detail->REC    = $REC[$key];
				$detail->ID 	= $ROW_IDXZZ;
                $detail->PER    = $periode;
                $detail->DEV    =  $this->devnya;
                $detail->DR    =  $this->drnya;
                $detail->FLAG    =  $this->FLAGZ;
                $detail->TGLD   = date('Y-m-d', strtotime($request['TGL']));
                $detail->ARTICLE    = ($ARTICLE[$key] == null) ? "" :  $ARTICLE[$key];
            //    $detail->MODE    = ($MODE[$key] == null) ? "" :  $MODE[$key];			
                $detail->CUTTING    = (float) str_replace(',', '', $CUTTING[$key]);
            //    $detail->cutting_t    = (float) str_replace(',', '', $cutting_t[$key]);
                $detail->EMBOS    = (float) str_replace(',', '', $EMBOS[$key]);
            //    $detail->embos_t    = (float) str_replace(',', '', $embos_t[$key]);
                $detail->PSP    = (float) str_replace(',', '', $PSP[$key]);
            //    $detail->psp_t    = (float) str_replace(',', '', $psp_t[$key]);
                $detail->JUKI    = (float) str_replace(',', '', $JUKI[$key]);
            //    $detail->juki_t    = (float) str_replace(',', '', $juki_t[$key]);
                $detail->JAHIT    = (float) str_replace(',', '', $JAHIT[$key]);
            //    $detail->jahit_t    = (float) str_replace(',', '', $jahit_t[$key]);
                $detail->PACKING    = (float) str_replace(',', '', $PACKING[$key]);
            //    $detail->packing_t    = (float) str_replace(',', '', $packing_t[$key]);
                $detail->INJECT    = (float) str_replace(',', '', $INJECT[$key]);
            //    $detail->injek    = (float) str_replace(',', '', $injek[$key]);
                $detail->CAT_SPRAY    = (float) str_replace(',', '', $CAT_SPRAY[$key]);
            //    $detail->cet_spray    = (float) str_replace(',', '', $cet_spray[$key]);
                $detail->PSP_CAT    = (float) str_replace(',', '', $PSP_CAT[$key]);
            //    $detail->psp_cet    = (float) str_replace(',', '', $psp_cet[$key]);
                $detail->PSP_FLOCK    = (float) str_replace(',', '', $PSP_FLOCK[$key]);
            //    $detail->psp_flok    = (float) str_replace(',', '', $psp_flok[$key]);
                $detail->FLOCKING    = (float) str_replace(',', '', $FLOCKING[$key]);
            //    $detail->floking    = (float) str_replace(',', '', $floking[$key]);
            //    $detail->ASSB_FLOCK    = (float) str_replace(',', '', $ASSB_FLOCK[$key]);
            //    $detail->ass_flok    = (float) str_replace(',', '', $ass_flok[$key]);
                $detail->COMP    = (float) str_replace(',', '', $COMP[$key]);
            //    $detail->kompon    = (float) str_replace(',', '', $kompon[$key]);
                $detail->GILING    = (float) str_replace(',', '', $GILING[$key]);
            //    $detail->geleng    = (float) str_replace(',', '', $geleng[$key]);
                $detail->PSP_ASSB    = (float) str_replace(',', '', $PSP_ASSB[$key]);
            //    $detail->psp_ass    = (float) str_replace(',', '', $psp_ass[$key]);
                $detail->STOCKFIT    = (float) str_replace(',', '', $STOCKFIT[$key]);
            //    $detail->stokfit    = (float) str_replace(',', '', $stokfit[$key]);
                $detail->ASSEMBLING    = (float) str_replace(',', '', $ASSEMBLING[$key]);
            //    $detail->ass    = (float) str_replace(',', '', $ass[$key]);
            //    $detail->INJECTION    = (float) str_replace(',', '', $INJECTION[$key]);
            //    $detail->injektion    = (float) str_replace(',', '', $injektion[$key]);
                $detail->ASSB_PACKING    = (float) str_replace(',', '', $ASSB_PACKING[$key]);
            //    $detail->ass_paking    = (float) str_replace(',', '', $ass_paking[$key]);
                $detail->MICRO    = (float) str_replace(',', '', $MICRO[$key]);
            //    $detail->mikro    = (float) str_replace(',', '', $mikro[$key]);
            //    $detail->BORDIR    = (float) str_replace(',', '', $BORDIR[$key]);
            //    $detail->gambar1    = ($gambar1[$key] == null) ? "" :  $gambar1[$key];		
            //    $detail->pdf1    = ($pdf1[$key] == null) ? "" :  $pdf1[$key];		
                $detail->USRNM    = Auth::user()->username;		
                $detail->E_TGL   = Carbon::now();
                $detail->E_PC   = Auth::user()->username;		
                $detail->tahun    = $tahunx;
            //    $detail->rekharga    = ($rekharga[$key] == null) ? "" :  $rekharga[$key];
                $detail->save();
            }
        }

        //  ganti 11

        $variablell = DB::select('call kasins(?)', array($no_bukti));
		
        $no_buktix = $no_bukti;
		
		$pengajuan = Pengajuan::where('NO_BUKTI', $no_buktix )->first();
					 
        return redirect('/pengajuan/edit/?idx=' . $pengajuan->ROW_ID . '&tipx=edit&flagz=' . $this->FLAGZ . '&judul=' . $this->judul . '');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Master\Rute  $rute
     * @return \Illuminate\Http\Response
     */


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Master\Rute  $rute
     * @return \Illuminate\Http\Response
     */

    // ganti 15

    public function edit( Request $request , Pengajuan $pengajuan)
    {


		$per = session()->get('periode')['bulan'] . '/' . session()->get('periode')['tahun'];
		
				
        $cekperid = DB::SELECT("SELECT POSTED from perid WHERE PERIO='$per'");
        if ($cekperid[0]->POSTED==1)
        {
            return redirect('/pengajuan')
			       ->with('status', 'Maaf Periode sudah ditutup!')
                   ->with(['judul' => $judul, 'flagz' => $FLAGZ]);
        }
		
		$this->setFlag($request);
		//DD($this->judul);
        $tipx = $request->tipx;

		$idx = $request->idx;
			

		
		if ( $idx =='0' && $tipx=='undo'  )
	    {
			$tipx ='top';
			
		   }
		   
		   
		if ($tipx=='search') {
			
			$buktix = $request->buktix;
			
		   $bingco = DB::SELECT("SELECT ROW_ID, NO_BUKTI from hrd_harga 
		                 where PER ='$per' and FLAG ='$this->FLAGZ' 
						 and NO_BUKTI = '$buktix'						 
		                 ORDER BY NO_BUKTI ASC  LIMIT 1" );
						 
		
			if(!empty($bingco)) 
			{
				$idx = $bingco[0]->ROW_ID;
			  }
			else
			{
				$idx = 0; 
			  }
		
					
		}
		
		if ($tipx=='top') {
			

		   $bingco = DB::SELECT("SELECT ROW_ID, NO_BUKTI from hrd_harga 
		                 where PER ='$per' and FLAG ='$this->FLAGZ'     
		                 ORDER BY NO_BUKTI ASC  LIMIT 1" );
						 
		
			if(!empty($bingco)) 
			{
				$idx = $bingco[0]->ROW_ID;
			  }
			else
			{
				$idx = 0; 
			  }
		
					
		}
		
		
		if ($tipx=='prev' ) {
			
    	   $buktix = $request->buktix;
			
		   $bingco = DB::SELECT("SELECT ROW_ID, NO_BUKTI from hrd_harga      
		             where PER ='$per' and FLAG ='$this->FLAGZ'  and NO_BUKTI < 
					 '$buktix' ORDER BY NO_BUKTI DESC LIMIT 1" );
			

			if(!empty($bingco)) 
			{
				$idx = $bingco[0]->ROW_ID;
			  }
			else
			{
				$idx = $idx; 
			  }
			  
		}
		
		
		if ($tipx=='next' ) {
			
				
      	   $buktix = $request->buktix;
	   
		   $bingco = DB::SELECT("SELECT ROW_ID, NO_BUKTI from hrd_harga    
		             where PER ='$per' and FLAG ='$this->FLAGZ'  and NO_BUKTI > 
					 '$buktix' ORDER BY NO_BUKTI ASC LIMIT 1" );
					 
			if(!empty($bingco)) 
			{
				$idx = $bingco[0]->ROW_ID;
			  }
			else
			{
				$idx = $idx; 
			  }
			  
			
		}

		if ($tipx=='bottom') {
		  
    		$bingco = DB::SELECT("SELECT ROW_ID, NO_BUKTI from hrd_harga  
					where PER ='$per'
            		and FLAG ='$this->FLAGZ'    
		            ORDER BY NO_BUKTI DESC  LIMIT 1" );
					 
			if(!empty($bingco)) 
			{
				$idx = $bingco[0]->ROW_ID;
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
			$pengajuan = Pengajuan::where('ROW_ID', $idx )->first();	
	     }
		 else
		 {
				$pengajuan = new Pengajuan;
                $pengajuan->TGL = Carbon::now();
      
				
		 }

        $no_bukti = $pengajuan->NO_BUKTI;
				
        $pengajuanDetail = DB::table('hrd_hargad')->where('NO_BUKTI', $no_bukti)->get();
        $data = [
            'header'        => $pengajuan,
            'detail'        => $pengajuanDetail
        ];
 
         
         return view('otransaksi_pengajuan.edit', $data)
		 ->with(['tipx' => $tipx, 'idx' => $idx, 'flagz' =>$this->FLAGZ, 'judul', $this->judul ]);
      
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Master\Rute  $rute
     * @return \Illuminate\Http\Response
     */

    // ganti 18

    public function update(Request $request, Pengajuan $pengajuan)
    {
        // return $request;
        $this->validate(
            $request,
            [
                // ganti 19
                'TGL'       => 'required',
            ]
        );

        // ganti 20

        $variablell = DB::select('call kasdel(?)', array($pengajuan['NO_BUKTI']));

		$this->setFlag($request);
        $FLAGZ = $this->FLAGZ;
        $judul = $this->judul;
		$devnya = $this->devnya;
		$drnya = $this->drnya;
		
        $periode = $request->session()->get('periode')['bulan'] . '/' . $request->session()->get('periode')['tahun'];
		$tahunx   = substr(session()->get('periode')['tahun'], -4);
      
        
        $pengajuan->update(
            [
				'TGL'              	=> date('Y-m-d', strtotime($request['TGL'])),
                'PER'              	=> $periode,
                'NOTES'            	=> ($request['NOTES'] == null) ? "" : $request['NOTES'],
                'DR'            	=> ($request['DR'] == null) ? "" : $request['DR'],
				'DEV'            	=> ($request['DEV'] == null) ? "" : $request['DEV'],
                'USRNM'            	=> Auth::user()->username,
                'E_TGL'            	=> Carbon::now(),
                'E_PC'            	=> Auth::user()->username,
                'DEV'    			=>  $devnya,
                'DR'    			=>  $drnya,
                'FLAG'    			=>  $FLAGZ,
                'ttd_ie'            => ($request['ttd_ie'] == null) ? "" : $request['ttd_ie'],
                'ie_off'            => ($request['ie_off'] == null) ? "" : $request['ie_off'],
                'nm_ttd_ie'         => ($request['nm_ttd_ie'] == null) ? "" : $request['nm_ttd_ie'],
                'tg_ttd_ie'         => date('Y-m-d', strtotime($request['tg_ttd_ie'])),
                'ttd_pr'            => ($request['ttd_pr'] == null) ? "" : $request['ttd_pr'],
                'pr_off'            => ($request['pr_off'] == null) ? "" : $request['pr_off'],
                'nm_ttd_pr'         => ($request['nm_ttd_pr'] == null) ? "" : $request['nm_ttd_pr'],
                'tg_ttd_pt'         => date('Y-m-d', strtotime($request['tg_ttd_pr'])),
                'ttd_fm'            => ($request['ttd_fm'] == null) ? "" : $request['ttd_fm'],
                'fm_off'            => ($request['fm_off'] == null) ? "" : $request['fm_off'],
                'nm_ttd_fm'         => ($request['nm_ttd_fm'] == null) ? "" : $request['nm_ttd_fm'],
                'tg_ttd_fm'         => date('Y-m-d', strtotime($request['tg_ttd_fm'])),
                'ttd_hrd'           => ($request['ttd_hrd'] == null) ? "" : $request['ttd_hrd'],
                'hrd_off'           => ($request['hrd_off'] == null) ? "" : $request['hrd_off'],
                'nm_ttd_hrd'        => ($request['nm_ttd_hrd'] == null) ? "" : $request['nm_ttd_hrd'],
                'tg_ttd_hrd'        => date('Y-m-d', strtotime($request['tg_ttd_hrd'])),
                'ttd_ceo'           => ($request['ttd_ceo'] == null) ? "" : $request['ttd_ceo'],
                'ceo_off'           => ($request['ceo_off'] == null) ? "" : $request['ceo_off'],
                'nm_ttd_ceo'        => ($request['nm_ttd_ceo'] == null) ? "" : $request['nm_ttd_ceo'],
                'tg_ttd_ceo'        => date('Y-m-d', strtotime($request['tg_ttd_ceo'])),
                'print'            	=> ($request['print'] == null) ? "" : $request['print'],
                'ket1'            	=> ($request['ket1'] == null) ? "" : $request['ket1'],
                'ket2'            	=> ($request['ket2'] == null) ? "" : $request['ket2'],
                'ket3'            	=> ($request['ket3'] == null) ? "" : $request['ket3'],
                'ket4'            	=> ($request['ket4'] == null) ? "" : $request['ket4'],
                'ket5'            	=> ($request['ket5'] == null) ? "" : $request['ket5'],
                'ket6'            	=> ($request['ket6'] == null) ? "" : $request['ket6'],
                'ket7'            	=> ($request['ket7'] == null) ? "" : $request['ket7'],
                'ket8'            	=> ($request['ket8'] == null) ? "" : $request['ket8'],
                'ket9'            	=> ($request['ket9'] == null) ? "" : $request['ket9'],
                'ket10'            	=> ($request['ket10'] == null) ? "" : $request['ket10'],
                'tahun'            	=> $tahunx

            ]
        );


		$no_buktix = $pengajuan->NO_BUKTI;
		$row_idxx = $pengajuan->ROW_ID; 
		
        // Update Detail
        $length = sizeof($request->input('REC'));

        $ROW_ID  = $request->input('ROW_ID');
		$ID 	= $row_idxx = $pengajuan->ROW_ID;
		$REC    = $request->input('REC');
        $DR    = $request->input('DR');
        $DEV    = $request->input('DEV');
        $NO_BUKTI    = $request->input('NO_BUKTI');	
        $PER    = $request->input('PER');
        $TGLD    = $request->input('TGLD');
        $ARTICLE    = $request->input('ARTICLE');
        $MODE    = $request->input('MODE');
        $CUTTING    = $request->input('CUTTING');
        $cutting_t    = $request->input('cutting_t');
        $EMBOS    = $request->input('EMBOS');
        $embos_t    = $request->input('embos_t');
        $PSP    = $request->input('PSP');
        $psp_t    = $request->input('psp_t');
        $JUKI    = $request->input('JUKI');
        $juki_t    = $request->input('juki_t');
        $JAHIT    = $request->input('JAHIT');
        $jahit_t    = $request->input('jahit_t');
        $PACKING    = $request->input('PACKING');
        $packing_t    = $request->input('packing_t');
        $INJECT    = $request->input('INJECT');
        $injek    = $request->input('injek');
        $CAT_SPRAY    = $request->input('CAT_SPRAY');
        $cet_spray    = $request->input('cet_spray');
        $PSP_CAT    = $request->input('PSP_CAT');
        $psp_cet    = $request->input('cet_spray');
        $PSP_FLOCK    = $request->input('PSP_FLOCK');
        $psp_flok    = $request->input('psp_flok');
        $FLOCKING    = $request->input('FLOCKING');
        $floking    = $request->input('floking');
        $ASSB_FLOCK    = $request->input('ASSB_FLOCK');
        $ass_flok    = $request->input('cet_spray');
        $COMP    = $request->input('COMP');
        $kompon    = $request->input('kompon');
        $GILING    = $request->input('GILING');
        $geleng    = $request->input('geleng');
        $PSP_ASSB    = $request->input('PSP_ASSB');
        $psp_ass    = $request->input('psp_ass');
        $STOCKFIT    = $request->input('STOCKFIT');
        $stokfit    = $request->input('stokfit');
        $ASSEMBLING    = $request->input('ASSEMBLING');
        $ass    = $request->input('ass');
        $INJECTION    = $request->input('INJECTION');
        $injektion    = $request->input('injektion');
        $ASSB_PACKING    = $request->input('ASSB_PACKING');
        $ass_paking    = $request->input('ass_paking');
        $MICRO    = $request->input('MICRO');
        $mikro    = $request->input('mikro');
        $BORDIR    = $request->input('BORDIR');
        $gambar1    = $request->input('gambar1');
        $pdf1    = $request->input('pdf1');
        $USRNM    = $request->input('USRNM');
        $E_TGL    = $request->input('E_TGL');
        $E_PC    = $request->input('E_PC');
        $tahun    = $request->input('tahun');
        $rekharga    = $request->input('rekharga');


        // Delete yang NO_ID tidak ada di input
        $query = DB::table('hrd_hargad')->where('NO_BUKTI', $request->NO_BUKTI)->whereNotIn('ROW_ID',  $ROW_ID)->delete();

        // Update / Insert
        for ($i = 0; $i < $length; $i++) {
            // Insert jika NO_ID baru
            if ($ROW_ID[$i] == 'new') {
                $insert = PengajuanDetail::create(
                    [
                        'NO_BUKTI'   => $request->NO_BUKTI,
                        'REC'    => $REC[$i],
                        'ID'    => $row_idxx,
                        'PER'    => $periode,
                        'DEV'    => $devnya,
						'DR' 	 => $drnya,
						'FLAG'   => $FLAGZ,
                        'TGLD'   => date('Y-m-d', strtotime($request['TGL'])),
                        'ARTICLE'    => ($ARTICLE[$i] == null) ? "" :  $ARTICLE[$i],
                    //    'MODE'    => ($MODE[$i] == null) ? "" :  $MODE[$i],			
                        'CUTTING'    => (float) str_replace(',', '', $CUTTING[$i]),
                    //    'cutting_t'    => (float) str_replace(',', '', $cutting_t[$i]),
                        'EMBOS'    => (float) str_replace(',', '', $EMBOS[$i]),
                    //    'embos_t'    => (float) str_replace(',', '', $embos_t[$i]),
                        'PSP'    => (float) str_replace(',', '', $PSP[$i]),
                    //    'psp_t'    => (float) str_replace(',', '', $psp_t[$i]),
                        'JUKI'    => (float) str_replace(',', '', $JUKI[$i]),
                    //    'juki_t'    => (float) str_replace(',', '', $juki_t[$i]),
                        'JAHIT'    => (float) str_replace(',', '', $JAHIT[$i]),
                    //    'jahit_t'    => (float) str_replace(',', '', $jahit_t[$i]),
                        'PACKING'    => (float) str_replace(',', '', $PACKING[$i]),
                    //    'packing_t'    => (float) str_replace(',', '', $packing_t[$i]),
                        'INJECT'    => (float) str_replace(',', '', $INJECT[$i]),
                    //    'injek'     => (float) str_replace(',', '', $injek[$i]),
                        'CAT_SPRAY'    => (float) str_replace(',', '', $CAT_SPRAY[$i]),
                    //    'cet_spray'    => (float) str_replace(',', '', $cet_spray[$i]),
                        'PSP_CAT'    => (float) str_replace(',', '', $PSP_CAT[$i]),
                    //    'psp_cet'    => (float) str_replace(',', '', $psp_cet[$i]),
                        'PSP_FLOCK'    => (float) str_replace(',', '', $PSP_FLOCK[$i]),
                    //    'psp_flok'    => (float) str_replace(',', '', $psp_flok[$i]),
                        'FLOCKING'    => (float) str_replace(',', '', $FLOCKING[$i]),
                    //    'floking'    => (float) str_replace(',', '', $floking[$i]),
                    //    'ASSB_FLOCK'    => (float) str_replace(',', '', $ASSB_FLOCK[$i]),
                    //    'ass_flok'    => (float) str_replace(',', '', $ass_flok[$i]),
                        'COMP'    => (float) str_replace(',', '', $COMP[$i]),
                    //    'kompon'    => (float) str_replace(',', '', $kompon[$i]),
                        'GILING'    => (float) str_replace(',', '', $GILING[$i]),
                    //    'geleng'    => (float) str_replace(',', '', $geleng[$i]),
                        'PSP_ASSB'    => (float) str_replace(',', '', $PSP_ASSB[$i]),
                    //    'psp_ass'    => (float) str_replace(',', '', $psp_ass[$i]),
                        'STOCKFIT'    => (float) str_replace(',', '', $STOCKFIT[$i]),
                    //    'stokfit'    => (float) str_replace(',', '', $stokfit[$i]),
                        'ASSEMBLING'    => (float) str_replace(',', '', $ASSEMBLING[$i]),
                    //    'ass'    => (float) str_replace(',', '', $ass[$i]),
                    //    'INJECTION'    => (float) str_replace(',', '', $INJECTION[$i]),
                    //    'injektion'    => (float) str_replace(',', '', $injektion[$i]),
                        'ASSB_PACKING'    => (float) str_replace(',', '', $ASSB_PACKING[$i]),
                    //    'ass_paking'    => (float) str_replace(',', '', $ass_paking[$i]),
                        'MICRO'    => (float) str_replace(',', '', $MICRO[$i]),
                    //    'mikro'    => (float) str_replace(',', '', $mikro[$i]),
                    //    'BORDIR'    => (float) str_replace(',', '', $BORDIR[$i]),
                    //    'gambar1'    => ($gambar1[$i] == null) ? "" :  $gambar1[$i],		
                    //    'pdf1'    => ($pdf1[$i] == null) ? "" :  $pdf1[$i],		
						'USRNM'    	=> Auth::user()->username,		
                        'E_TGL'   	=> Carbon::now(),
                        'E_PC'   	=> Auth::user()->username,		
                        'tahun'    => $tahunx,
                    //    'rekharga'    => ($rekharga[$i] == null) ? "" :  $rekharga[$i],
					
                    ]
                );
            } else {
                // Update jika NO_ID sudah ada
                $update = PengajuanDetail::updateOrCreate(
                    [
                        'NO_BUKTI'  => $request->NO_BUKTI,
                        'ROW_ID'     => (int) str_replace(',', '', $ROW_ID[$i])
                    ],

                    [
                        'REC'    => $REC[$i],
                        'ID'    => $row_idxx,
                        'PER'    => $periode,
                        'DEV'    => $devnya,
						'DR' 	 => $drnya,
						'FLAG'   => $FLAGZ,
						'TGLD'   => date('Y-m-d', strtotime($request['TGL'])),
                        'ARTICLE'    => ($ARTICLE[$i] == null) ? "" :  $ARTICLE[$i],
                    //    'MODE'    => ($MODE[$i] == null) ? "" :  $MODE[$i],			
                        'CUTTING'    => (float) str_replace(',', '', $CUTTING[$i]),
                    //    'cutting_t'    => (float) str_replace(',', '', $cutting_t[$i]),
                        'EMBOS'    => (float) str_replace(',', '', $EMBOS[$i]),
                    //    'embos_t'    => (float) str_replace(',', '', $embos_t[$i]),
                        'PSP'    => (float) str_replace(',', '', $PSP[$i]),
                    //    'psp_t'    => (float) str_replace(',', '', $psp_t[$i]),
                        'JUKI'    => (float) str_replace(',', '', $JUKI[$i]),
                    //    'juki_t'    => (float) str_replace(',', '', $juki_t[$i]),
                        'JAHIT'    => (float) str_replace(',', '', $JAHIT[$i]),
                    //    'jahit_t'    => (float) str_replace(',', '', $jahit_t[$i]),
                        'PACKING'    => (float) str_replace(',', '', $PACKING[$i]),
                    //    'packing_t'    => (float) str_replace(',', '', $packing_t[$i]),
                        'INJECT'    => (float) str_replace(',', '', $INJECT[$i]),
                    //    'injek'     => (float) str_replace(',', '', $injek[$i]),
                        'CAT_SPRAY'    => (float) str_replace(',', '', $CAT_SPRAY[$i]),
                    //    'cet_spray'    => (float) str_replace(',', '', $cet_spray[$i]),
                        'PSP_CAT'    => (float) str_replace(',', '', $PSP_CAT[$i]),
                    //    'psp_cet'    => (float) str_replace(',', '', $psp_cet[$i]),
                        'PSP_FLOCK'    => (float) str_replace(',', '', $PSP_FLOCK[$i]),
                    //    'psp_flok'    => (float) str_replace(',', '', $psp_flok[$i]),
                        'FLOCKING'    => (float) str_replace(',', '', $FLOCKING[$i]),
                    //    'floking'    => (float) str_replace(',', '', $floking[$i]),
                    //    'ASSB_FLOCK'    => (float) str_replace(',', '', $ASSB_FLOCK[$i]),
                    //    'ass_flok'    => (float) str_replace(',', '', $ass_flok[$i]),
                        'COMP'    => (float) str_replace(',', '', $COMP[$i]),
                    //    'kompon'    => (float) str_replace(',', '', $kompon[$i]),
                        'GILING'    => (float) str_replace(',', '', $GILING[$i]),
                    //    'geleng'    => (float) str_replace(',', '', $geleng[$i]),
                        'PSP_ASSB'    => (float) str_replace(',', '', $PSP_ASSB[$i]),
                    //    'psp_ass'    => (float) str_replace(',', '', $psp_ass[$i]),
                        'STOCKFIT'    => (float) str_replace(',', '', $STOCKFIT[$i]),
                    //    'stokfit'    => (float) str_replace(',', '', $stokfit[$i]),
                        'ASSEMBLING'    => (float) str_replace(',', '', $ASSEMBLING[$i]),
                    //    'ass'    => (float) str_replace(',', '', $ass[$i]),
                    //    'INJECTION'    => (float) str_replace(',', '', $INJECTION[$i]),
                    //    'injektion'    => (float) str_replace(',', '', $injektion[$i]),
                        'ASSB_PACKING'    => (float) str_replace(',', '', $ASSB_PACKING[$i]),
                    //    'ass_paking'    => (float) str_replace(',', '', $ass_paking[$i]),
                        'MICRO'    => (float) str_replace(',', '', $MICRO[$i]),
                    //    'mikro'    => (float) str_replace(',', '', $mikro[$i]),
                    //    'BORDIR'    => (float) str_replace(',', '', $BORDIR[$i]),
                    //    'gambar1'    => ($gambar1[$i] == null) ? "" :  $gambar1[$i],		
                    //    'pdf1'    => ($pdf1[$i] == null) ? "" :  $pdf1[$i],		
						'USRNM'    	=> Auth::user()->username,		
                        'E_TGL'   	=> Carbon::now(),
                        'E_PC'   	=> Auth::user()->username,		
                        'tahun'    => $tahunx,
                    //    'rekharga'    => ($rekharga[$i] == null) ? "" :  $rekharga[$i],

                    ]
                );
            }
        }

        // ganti 21
		
       $variablell = DB::select('call kasins(?)', array($pengajuan['NO_BUKTI']));
	   
       // return redirect('/pengajuan')->with('status', 'Data baru berhasil diedit');
	   
	    $pengajuan = Pengajuan::where('NO_BUKTI', $no_buktix )->first();
					 
        return redirect('/pengajuan/edit/?idx=' . $pengajuan->ROW_ID . '&tipx=edit&flagz=' . $this->FLAGZ . '&judul=' . $this->judul . '');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Master\Rute  $rute
     * @return \Illuminate\Http\Response
     */

    // ganti 22

    public function destroy(Request $request, Pengajuan $pengajuan)
    {
    
		$per = session()->get('periode')['bulan'] . '/' . session()->get('periode')['tahun'];


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

		
		$variablell = DB::select('call kasdel(?)', array($pengajuan['NO_BUKTI']));

        // ganti 23

        $deletePengajuan = Pengajuan::find($pengajuan->ROW_ID);

        // ganti 24
        $deletePengajuan->delete();

        // ganti 
		return redirect('/pengajuan?flagz='.$FLAGZ)->with(['judul' => $judul, 'flagz' => $FLAGZ ])->with('statusHapus', 'Data '.$pengajuan->NO_BUKTI.' berhasil dihapus');
		
		
    }


    public function jasperPengajuanTrans(Pengajuan $pengajuan)
    {
        $no_bukti = $pengajuan->NO_BUKTI;

        $file     = 'kasc';
        $PHPJasperXML = new PHPJasperXML();
        $PHPJasperXML->load_xml_file(base_path() . ('/app/reportc01/phpjasperxml/' . $file . '.jrxml'));

        $query = DB::SELECT("
			SELECT kas.NO_BUKTI,kas.TGL,kas.KET,kas.BNAMA,
            kasd.REC,kasd.ACNO,kasd.NACNO,kasd.URAIAN,if(kasd.DEBET>=0,kasd.DEBET,kasd.KREDIT) as JUMLAH 
			FROM kas, kasd 
			WHERE kas.NO_BUKTI=kasd.NO_BUKTI and kas.NO_BUKTI='$no_bukti' 
			ORDER BY kas.NO_BUKTI;
		");

        $data = [];
        foreach ($query as $key => $value) {
            array_push($data, array(
                'NO_BUKTI' => $query[$key]->NO_BUKTI,
                'TGL' => $query[$key]->TGL,
                'KET' => $query[$key]->KET,
                'BNAMA' => $query[$key]->BNAMA,
                'REC' => $query[$key]->REC,
                'ACNO' => $query[$key]->ACNO,
                'NACNO' => $query[$key]->NACNO,
                'URAIAN' => $query[$key]->URAIAN,
                'JUMLAH' => $query[$key]->JUMLAH,
            ));
        }
        $PHPJasperXML->setData($data);
        ob_end_clean();
        $PHPJasperXML->outpage("I");
    }

    public function validasi1(Request $request, Pengajuan $Pengajuan)
    {
        $username = Auth::user()->USERNAME;
        $Pengajuan->update(
            [
				'VAL'              => "1",
                'TTD2'             => '1',
                'TTD2_USR'         => $username,
                'TTD2_SMP'         => date("Y-m-d h:i a"),
                'OK'               => '1',
            ]
        );
        
        return redirect('/Pengajuan/edit/'.$Pengajuan->ROW_ID);
    }

    public function validasi2(Request $request, Pengajuan $Pengajuan)
    {
        $username = Auth::user()->USERNAME;
        $Pengajuan->update(
            [
				'VAL'              => "1",
                'TTD2'             => '1',
                'TTD2_USR'         => $username,
                'TTD2_SMP'         => date("Y-m-d h:i a"),
                'OK'               => '1',
            ]
        );
        
        return redirect('/Pengajuan/edit/'.$Pengajuan->ROW_ID);
    }

    public function validasi3(Request $request, Pengajuan $Pengajuan)
    {
        $username = Auth::user()->USERNAME;
        $Pengajuan->update(
            [
				'VAL'              => "1",
                'TTD2'             => '1',
                'TTD2_USR'         => $username,
                'TTD2_SMP'         => date("Y-m-d h:i a"),
                'OK'               => '1',
            ]
        );
        
        return redirect('/Pengajuan/edit/'.$Pengajuan->ROW_ID);
    }

    public function validasi4(Request $request, Pengajuan $Pengajuan)
    {
        $username = Auth::user()->USERNAME;
        $Pengajuan->update(
            [
				'VAL'              => "1",
                'TTD2'             => '1',
                'TTD2_USR'         => $username,
                'TTD2_SMP'         => date("Y-m-d h:i a"),
                'OK'               => '1',
            ]
        );
        
        return redirect('/Pengajuan/edit/'.$Pengajuan->ROW_ID);
    }

    public function validasi5(Request $request, Pengajuan $Pengajuan)
    {
        $username = Auth::user()->USERNAME;
        $Pengajuan->update(
            [
				'VAL'              => "1",
                'TTD2'             => '1',
                'TTD2_USR'         => $username,
                'TTD2_SMP'         => date("Y-m-d h:i a"),
                'OK'               => '1',
            ]
        );
        
        return redirect('/Pengajuan/edit/'.$Pengajuan->ROW_ID);
    }
}
