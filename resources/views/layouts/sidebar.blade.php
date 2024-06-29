<style>
.nav-item li.active {
  border-bottom: 3px solid #338ecf;
  background: #494e52;
}
</style>

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{url('/')}}" class="brand-link" style="text-align: center">
      <img src="{{url('/img/company.jpg')}}" alt="Logo Jago" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Inti Dragon</span>
    </a>

    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        {{-- <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="test">
        </div> --}}
        <div class="info">
          <a href="{{url('profile')}}" class="d-block">{{ Auth::user()->name }}</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
          <!-- <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
              <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-sidebar">
                  <i class="fas fa-search fa-fw"></i>
                </button>
              </div>
            </div>
          </div> -->

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="{{url('/')}}" class="nav-link {{ (Request::is('/')) ? 'active' : '' }}">
              <i class="nav-icon fas fa-home"></i>
              <p>Home</p>
            </a>
          </li>
          


<!--------------------------------------------------------------------------------------->
		<li class="nav-header">MASTER</li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-adjust icon-red"></i>
              <p>
                Account
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>

            <ul class="nav nav-treeview">
              <!-- IF check privilege & divisi -->
			  
              @if ( (Auth::user()->divisi=="programmer") || (Auth::user()->divisi=="owner") || (Auth::user()->divisi=="assistant") || (Auth::user()->divisi=="kasir") || (Auth::user()->divisi=="accounting") )             
              <li class="nav-item">
                <a href="{{url('account')}}" class="nav-link">
                  <!-- <i class="nav-icon fas fa-adjust icon-green "></i> -->
                  <p>Account</p>
                </a>
              </li>
              @endif
            </ul>			 
          </li>	

		  <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-map-pin icon-orange"></i>
              <p>
                Wilayah
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>

            <ul class="nav nav-treeview">
              <!-- IF check privilege & divisi -->
			  
              @if ( (Auth::user()->divisi=="programmer") || (Auth::user()->divisi=="owner") || (Auth::user()->divisi=="assistant") || (Auth::user()->divisi=="kasir") || (Auth::user()->divisi=="accounting") )             
              <li class="nav-item">
                <a href="{{url('wila')}}" class="nav-link">
                  <!-- <i class="nav-icon fa fa-map-pin icon-white "></i> -->
                  <p>Wilayah</p>
                </a>
              </li>
              @endif
            </ul>			 
          </li>	
<!--------------------------------------------------------------------------------------->


<!--------------------------------------------------------------------------------------->
		  <li class="nav-header">Transaksi</li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-briefcase icon-blue"></i>
              <p>
                Kas
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>

            <ul class="nav nav-treeview">
              <!-- IF check privilege & divisi -->
			  
              @if ( (Auth::user()->divisi=="programmer") || (Auth::user()->divisi=="owner") || (Auth::user()->divisi=="assistant") || (Auth::user()->divisi=="kasir") || (Auth::user()->divisi=="accounting") )             
              <li class="nav-item">
                <!-- <a href="{{url('kas')}}" class="nav-link"> -->
				        <a href="{{url('kas?flagz=BKM')}}" class="nav-link">
                  <!-- <i class="nav-icon fas fa-archive icon-white "></i> -->
                  <p>Kas Masuk</p>
                </a>
              </li>
              @endif

              @if ( (Auth::user()->divisi=="programmer") || (Auth::user()->divisi=="owner") || (Auth::user()->divisi=="assistant") || (Auth::user()->divisi=="kasir") || (Auth::user()->divisi=="accounting") )             
              <li class="nav-item">
                <!-- <a href="{{url('kask')}}" class="nav-link"> -->
				        <a href="{{url('kas?flagz=BKK')}}" class="nav-link">
                  <!-- <i class="nav-icon fas fa-archive icon-yellow "></i> -->
                  <p>Kas Keluar</p>
                </a>
              </li>
              @endif
			 
            </ul>			 
        </li>

<!--------------------------------------------------------------------------------------->
         
          
<li class="nav-item ">          
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-university icon-yellow"></i>
              <p>
                Bank
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>


<!------griffin----------------------------------------------------------------->

		<ul class="nav nav-treeview">


			  <li class="nav-item ">          
					<a href="#" class="nav-link">
						<i class="nav-icon fa fa-university icon-white"></i>
						<p>
							BCA RUPIAH
							<i class="right fas fa-angle-left"></i>
						</p>
					</a>

					<ul class="nav nav-treeview">
              
						<li class="nav-item {{ (Request::is('pakai*')) ? 'active' : '' }}">
							<a href="{{url('bank?flagz=BBM&bacnoz=111')}}" class="nav-link">
							<!-- <i class="nav-icon far fa-sticky-note icon-pink"></i> -->
								<p>Bank Masuk</p>
							</a>
              
						</li>

						<li class="nav-item {{ (Request::is('pakai*')) ? 'active' : '' }}">
							<a href="{{url('bank?flagz=BBK&bacnoz=111')}}" class="nav-link">
							<!-- <i class="nav-icon far fa-sticky-note icon-pink"></i> -->
								<p>Bank Keluar</p>
							</a>
              
						</li>

					</ul>
				</li>

        <li class="nav-item ">          
					<a href="#" class="nav-link">
						<i class="nav-icon fa fa-university icon-white"></i>
						<p>
							BCA USD
							<i class="right fas fa-angle-left"></i>
						</p>
					</a>

					<ul class="nav nav-treeview">
              
						<li class="nav-item {{ (Request::is('pakai*')) ? 'active' : '' }}">
							<a href="{{url('bank?flagz=BBM&bacnoz=111.01')}}" class="nav-link">
							<!-- <i class="nav-icon far fa-sticky-note icon-pink"></i> -->
								<p>Bank Masuk</p>
							</a>
              
						</li>

						<li class="nav-item {{ (Request::is('pakai*')) ? 'active' : '' }}">
							<a href="{{url('bank?flagz=BBK&bacnoz=111.01')}}" class="nav-link">
							<!-- <i class="nav-icon far fa-sticky-note icon-pink"></i> -->
								<p>Bank Keluar</p>
							</a>
              
						</li>

					</ul>
        </li>

        <li class="nav-item ">          
					<a href="#" class="nav-link">
						<i class="nav-icon fa fa-university icon-white"></i>
						<p>
							BCA EURO
							<i class="right fas fa-angle-left"></i>
						</p>
					</a>

					<ul class="nav nav-treeview">
              
						<li class="nav-item {{ (Request::is('pakai*')) ? 'active' : '' }}">
							<a href="{{url('bank?flagz=BBM&bacnoz=111.02')}}" class="nav-link">
							<!-- <i class="nav-icon far fa-sticky-note icon-pink"></i> -->
								<p>Bank Masuk</p>
							</a>
              
						</li>

						<li class="nav-item {{ (Request::is('pakai*')) ? 'active' : '' }}">
							<a href="{{url('bank?flagz=BBK&bacnoz=111.02')}}" class="nav-link">
							<!-- <i class="nav-icon far fa-sticky-note icon-pink"></i> -->
								<p>Bank Keluar</p>
							</a>
              
						</li>

					</ul>
        </li>

        <li class="nav-item ">          
					<a href="#" class="nav-link">
						<i class="nav-icon fa fa-university icon-blue"></i>
						<p>
							UOB IDR
							<i class="right fas fa-angle-left"></i>
						</p>
					</a>

					<ul class="nav nav-treeview">
              
						<li class="nav-item {{ (Request::is('pakai*')) ? 'active' : '' }}">
							<a href="{{url('bank?flagz=BBM&bacnoz=112')}}" class="nav-link">
							<!-- <i class="nav-icon far fa-sticky-note icon-pink"></i> -->
								<p>Bank Masuk</p>
							</a>
              
						</li>

						<li class="nav-item {{ (Request::is('pakai*')) ? 'active' : '' }}">
							<a href="{{url('bank?flagz=BBK&bacnoz=112')}}" class="nav-link">
							<!-- <i class="nav-icon far fa-sticky-note icon-pink"></i> -->
								<p>Bank Keluar</p>
							</a>
              
						</li>

					</ul>
        </li>	

        <li class="nav-item ">          
          <a href="#" class="nav-link">
						<i class="nav-icon fa fa-university icon-blue"></i>
						<p>
							UOB USD
							<i class="right fas fa-angle-left"></i>
						</p>
					</a>

					<ul class="nav nav-treeview">
              
						<li class="nav-item {{ (Request::is('pakai*')) ? 'active' : '' }}">
							<a href="{{url('bank?flagz=BBM&bacnoz=112.01')}}" class="nav-link">
							<!-- <i class="nav-icon far fa-sticky-note icon-pink"></i> -->
								<p>Bank Masuk</p>
							</a>
              
						</li>

						<li class="nav-item {{ (Request::is('pakai*')) ? 'active' : '' }}">
							<a href="{{url('bank?flagz=BBK&bacnoz=112.01')}}" class="nav-link">
							<!-- <i class="nav-icon far fa-sticky-note icon-pink"></i> -->
								<p>Bank Keluar</p>
							</a>
              
						</li>

					</ul>
        </li>

        <li class="nav-item ">          
          <a href="#" class="nav-link">
						<i class="nav-icon fa fa-university icon-grey"></i>
						<p>
							HSBC
							<i class="right fas fa-angle-left"></i>
						</p>
					</a>

					<ul class="nav nav-treeview">
              
						<li class="nav-item {{ (Request::is('pakai*')) ? 'active' : '' }}">
							<a href="{{url('bank?flagz=BBM&bacnoz=113')}}" class="nav-link">
							<!-- <i class="nav-icon far fa-sticky-note icon-pink"></i> -->
								<p>Bank Masuk</p>
							</a>
              
						</li>

						<li class="nav-item {{ (Request::is('pakai*')) ? 'active' : '' }}">
							<a href="{{url('bank?flagz=BBK&bacnoz=113')}}" class="nav-link">
							<!-- <i class="nav-icon far fa-sticky-note icon-pink"></i> -->
								<p>Bank Keluar</p>
							</a>
              
						</li>

					</ul>
        </li>

        <li class="nav-item ">          
          <a href="#" class="nav-link">
						<i class="nav-icon fa fa-university icon-green"></i>
						<p>
							DANAMON FLEXIMAX
							<i class="right fas fa-angle-left"></i>
						</p>
					</a>

					<ul class="nav nav-treeview">
              
						<li class="nav-item {{ (Request::is('pakai*')) ? 'active' : '' }}">
							<a href="{{url('bank?flagz=BBM&bacnoz=114')}}" class="nav-link">
							<!-- <i class="nav-icon far fa-sticky-note icon-pink"></i> -->
								<p>Bank Masuk</p>
							</a>
              
						</li>

						<li class="nav-item {{ (Request::is('pakai*')) ? 'active' : '' }}">
							<a href="{{url('bank?flagz=BBK&bacnoz=114')}}" class="nav-link">
							<!-- <i class="nav-icon far fa-sticky-note icon-pink"></i> -->
								<p>Bank Keluar</p>
							</a>
              
						</li>

					</ul>
        </li>

        <li class="nav-item ">          
          <a href="#" class="nav-link">
						<i class="nav-icon fa fa-university icon-green"></i>
						<p>
							DANAMON PRIMAGIRO
							<i class="right fas fa-angle-left"></i>
						</p>
					</a>

					<ul class="nav nav-treeview">
              
						<li class="nav-item {{ (Request::is('pakai*')) ? 'active' : '' }}">
							<a href="{{url('bank?flagz=BBM&bacnoz=114.01')}}" class="nav-link">
							<!-- <i class="nav-icon far fa-sticky-note icon-pink"></i> -->
								<p>Bank Masuk</p>
							</a>
              
						</li>

						<li class="nav-item {{ (Request::is('pakai*')) ? 'active' : '' }}">
							<a href="{{url('bank?flagz=BBK&bacnoz=114.01')}}" class="nav-link">
							<!-- <i class="nav-icon far fa-sticky-note icon-pink"></i> -->
								<p>Bank Keluar</p>
							</a>
              
						</li>

					</ul>
        </li>

        <li class="nav-item ">          
          <a href="#" class="nav-link">
						<i class="nav-icon fa fa-university icon-green"></i>
						<p>
							DANAMON USD
							<i class="right fas fa-angle-left"></i>
						</p>
					</a>

					<ul class="nav nav-treeview">
              
						<li class="nav-item {{ (Request::is('pakai*')) ? 'active' : '' }}">
							<a href="{{url('bank?flagz=BBM&bacnoz=114.02')}}" class="nav-link">
							<!-- <i class="nav-icon far fa-sticky-note icon-pink"></i> -->
								<p>Bank Masuk</p>
							</a>
              
						</li>

						<li class="nav-item {{ (Request::is('pakai*')) ? 'active' : '' }}">
							<a href="{{url('bank?flagz=BBK&bacnoz=114.02')}}" class="nav-link">
							<!-- <i class="nav-icon far fa-sticky-note icon-pink"></i> -->
								<p>Bank Keluar</p>
							</a>
              
						</li>

					</ul>
        </li>

        <li class="nav-item ">          
          <a href="#" class="nav-link">
						<i class="nav-icon fa fa-university icon-red"></i>
						<p>
							ARTOZ IDR
							<i class="right fas fa-angle-left"></i>
						</p>
					</a>

					<ul class="nav nav-treeview">
              
						<li class="nav-item {{ (Request::is('pakai*')) ? 'active' : '' }}">
							<a href="{{url('bank?flagz=BBM&bacnoz=115')}}" class="nav-link">
							<!-- <i class="nav-icon far fa-sticky-note icon-pink"></i> -->
								<p>Bank Masuk</p>
							</a>
              
						</li>

						<li class="nav-item {{ (Request::is('pakai*')) ? 'active' : '' }}">
							<a href="{{url('bank?flagz=BBK&bacnoz=115')}}" class="nav-link">
							<!-- <i class="nav-icon far fa-sticky-note icon-pink"></i> -->
								<p>Bank Keluar</p>
							</a>
              
						</li>

					</ul>
        </li>

        <li class="nav-item ">          
          <a href="#" class="nav-link">
						<i class="nav-icon fa fa-university icon-pink"></i>
						<p>
							ANZ USD
							<i class="right fas fa-angle-left"></i>
						</p>
					</a>

					<ul class="nav nav-treeview">
              
						<li class="nav-item {{ (Request::is('pakai*')) ? 'active' : '' }}">
							<a href="{{url('bank?flagz=BBM&bacnoz=115.01')}}" class="nav-link">
							<!-- <i class="nav-icon far fa-sticky-note icon-pink"></i> -->
								<p>Bank Masuk</p>
							</a>
              
						</li>

						<li class="nav-item {{ (Request::is('pakai*')) ? 'active' : '' }}">
							<a href="{{url('bank?flagz=BBK&bacnoz=115.01')}}" class="nav-link">
							<!-- <i class="nav-icon far fa-sticky-note icon-pink"></i> -->
								<p>Bank Keluar</p>
							</a>
              
						</li>

					</ul>
        </li>

        <li class="nav-item ">          
          <a href="#" class="nav-link">
						<i class="nav-icon fa fa-university icon-blue"></i>
						<p>
							BRI
							<i class="right fas fa-angle-left"></i>
						</p>
					</a>

					<ul class="nav nav-treeview">
              
						<li class="nav-item {{ (Request::is('pakai*')) ? 'active' : '' }}">
							<a href="{{url('bank?flagz=BBM&bacnoz=116')}}" class="nav-link">
							<!-- <i class="nav-icon far fa-sticky-note icon-pink"></i> -->
								<p>Bank Masuk</p>
							</a>
              
						</li>

						<li class="nav-item {{ (Request::is('pakai*')) ? 'active' : '' }}">
							<a href="{{url('bank?flagz=BBK&bacnoz=116')}}" class="nav-link">
							<!-- <i class="nav-icon far fa-sticky-note icon-pink"></i> -->
								<p>Bank Keluar</p>
							</a>
              
						</li>

					</ul>
        </li>

        <li class="nav-item ">          
          <a href="#" class="nav-link">
						<i class="nav-icon fa fa-university icon-orange"></i>
						<p>
							PERMATA IDR
							<i class="right fas fa-angle-left"></i>
						</p>
					</a>

					<ul class="nav nav-treeview">
              
						<li class="nav-item {{ (Request::is('pakai*')) ? 'active' : '' }}">
							<a href="{{url('bank?flagz=BBM&bacnoz=118')}}" class="nav-link">
							<!-- <i class="nav-icon far fa-sticky-note icon-pink"></i> -->
								<p>Bank Masuk</p>
							</a>
              
						</li>

						<li class="nav-item {{ (Request::is('pakai*')) ? 'active' : '' }}">
							<a href="{{url('bank?flagz=BBK&bacnoz=118')}}" class="nav-link">
							<!-- <i class="nav-icon far fa-sticky-note icon-pink"></i> -->
								<p>Bank Keluar</p>
							</a>
              
						</li>

					</ul>
        </li>

        <li class="nav-item ">          
          <a href="#" class="nav-link">
						<i class="nav-icon fa fa-university icon-orange"></i>
						<p>
							PERMATA USD
							<i class="right fas fa-angle-left"></i>
						</p>
					</a>

					<ul class="nav nav-treeview">
              
						<li class="nav-item {{ (Request::is('pakai*')) ? 'active' : '' }}">
							<a href="{{url('bank?flagz=BBM&bacnoz=118.01')}}" class="nav-link">
							<!-- <i class="nav-icon far fa-sticky-note icon-pink"></i> -->
								<p>Bank Masuk</p>
							</a>
              
						</li>

						<li class="nav-item {{ (Request::is('pakai*')) ? 'active' : '' }}">
							<a href="{{url('bank?flagz=BBK&bacnoz=118.01')}}" class="nav-link">
							<!-- <i class="nav-icon far fa-sticky-note icon-pink"></i> -->
								<p>Bank Keluar</p>
							</a>
              
						</li>

					</ul>
        </li>
	

		</ul>
<!---------- griff2 ------------------------------------------------------------->

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-clipboard icon-green"></i>
              <p>
                Memo
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>

            <ul class="nav nav-treeview">
              <!-- IF check privilege & divisi -->
			  
              @if ( (Auth::user()->divisi=="programmer") || (Auth::user()->divisi=="owner") || (Auth::user()->divisi=="assistant") || (Auth::user()->divisi=="kasir") || (Auth::user()->divisi=="accounting") )             
              <li class="nav-item">
                <a href="{{url('memo?flagz=M')}}" class="nav-link">
                  <!-- <i class="nav-icon fas fa-archive icon-white "></i> -->
                  <p>Memo</p>
                </a>
              </li>
              @endif
            </ul>			 
          </li>


<!--------------------------------------------------------------------------------------->

<!---------- griff2 ------------------------------------------------------------->

      
		<li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-clipboard icon-green"></i>
              <p>
                Validasi
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>

            <ul class="nav nav-treeview">
              <!-- IF check privilege & divisi -->
			  
              @if ( (Auth::user()->divisi=="programmer") || (Auth::user()->divisi=="owner") || (Auth::user()->divisi=="assistant") || (Auth::user()->divisi=="kasir") || (Auth::user()->divisi=="accounting") )             
              <li class="nav-item">
                <a href="{{url('lpb')}}" class="nav-link">
                  <!-- <i class="nav-icon fas fa-archive icon-white "></i> -->
                  <p>Validasi LPB</p>
                </a>
              </li>
              @endif
            </ul>			 
          </li>

<!--------------------------------------------------------------------------------------->
		<li class="nav-item">
							
				@if ( (Auth::user()->divisi=="programmer") || (Auth::user()->divisi=="owner") || (Auth::user()->divisi=="assistant") || (Auth::user()->divisi=="kasir") || (Auth::user()->divisi=="accounting") )             
              <li class="nav-item">
                <a href="{{url('bg')}}" class="nav-link">
                  <i class="nav-icon fa fa-check-square icon-grey "></i>
                  <p>Cek BG</p>
                </a>
              </li>
              @endif
			  
			  @if ( (Auth::user()->divisi=="programmer") || (Auth::user()->divisi=="owner") || (Auth::user()->divisi=="assistant") || (Auth::user()->divisi=="kasir") || (Auth::user()->divisi=="accounting") )             
              <li class="nav-item">
                <a href="{{url('slip')}}" class="nav-link">
                  <i class="nav-icon fa fa-bug icon-orange "></i>
                  <p>Form Slip</p>
                </a>
              </li>
              @endif

			  <!-- @if ( (Auth::user()->divisi=="programmer") || (Auth::user()->divisi=="owner") || (Auth::user()->divisi=="assistant") || (Auth::user()->divisi=="kasir") || (Auth::user()->divisi=="accounting") )             
              <li class="nav-item">
                <a href="{{url('slip')}}" class="nav-link">
                  <i class="nav-icon fa fa-building icon-pink "></i>
                  <p>Data BKK</p>
                </a>
              </li>
              @endif	  -->
		</li>

<!--------------------------------------------------------------------------------------->

		<!-- <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-briefcase icon-pink"></i>
              <p>
                Pengajuan Harga
                <i class="right fas fa-angle-left"></i>
              </p>
            </a> -->

            <!-- <ul class="nav nav-treeview"> -->
              <!-- IF check privilege & divisi -->
			  
              <!-- @if ( (Auth::user()->divisi=="programmer") || (Auth::user()->divisi=="owner") || (Auth::user()->divisi=="assistant") || (Auth::user()->divisi=="kasir") || (Auth::user()->divisi=="accounting") )             
              <li class="nav-item">
                <a href="{{url('pengajuan?flagz=1IJ')}}" class="nav-link"> -->
                  <!-- <i class="nav-icon fas fa-archive icon-white "></i> -->
                  <!-- <p>Borongan Dragon 1</p>
                </a>
              </li>
              @endif

              @if ( (Auth::user()->divisi=="programmer") || (Auth::user()->divisi=="owner") || (Auth::user()->divisi=="assistant") || (Auth::user()->divisi=="kasir") || (Auth::user()->divisi=="accounting") )             
              <li class="nav-item">
                <a href="{{url('pengajuan?flagz=2CV')}}" class="nav-link"> -->
                  <!-- <i class="nav-icon fas fa-archive icon-yellow "></i> -->
                  <!-- <p>Borongan Vulcanized</p>
                </a>
              </li>
              @endif
			 
			  @if ( (Auth::user()->divisi=="programmer") || (Auth::user()->divisi=="owner") || (Auth::user()->divisi=="assistant") || (Auth::user()->divisi=="kasir") || (Auth::user()->divisi=="accounting") )             
              <li class="nav-item">
                <a href="{{url('pengajuan?flagz=2CM')}}" class="nav-link"> -->
                  <!-- <i class="nav-icon fas fa-archive icon-yellow "></i> -->
                  <!-- <p>Borongan Cemeting</p>
                </a>
              </li>
              @endif
			  
			  @if ( (Auth::user()->divisi=="programmer") || (Auth::user()->divisi=="owner") || (Auth::user()->divisi=="assistant") || (Auth::user()->divisi=="kasir") || (Auth::user()->divisi=="accounting") )             
              <li class="nav-item">
                <a href="{{url('pengajuan?flagz=2IJ')}}" class="nav-link"> -->
                  <!-- <i class="nav-icon fas fa-archive icon-yellow "></i> -->
                  <!-- <p>Borongan Inject DR 2</p>
                </a>
              </li>
              @endif
			  
			  @if ( (Auth::user()->divisi=="programmer") || (Auth::user()->divisi=="owner") || (Auth::user()->divisi=="assistant") || (Auth::user()->divisi=="kasir") || (Auth::user()->divisi=="accounting") )             
              <li class="nav-item">
                <a href="{{url('pengajuan?flagz=3IJ')}}" class="nav-link"> -->
                  <!-- <i class="nav-icon fas fa-archive icon-yellow "></i> -->
                  <!-- <p>Borongan Dragon 3</p>
                </a>
              </li>
              @endif
			  
			  @if ( (Auth::user()->divisi=="programmer") || (Auth::user()->divisi=="owner") || (Auth::user()->divisi=="assistant") || (Auth::user()->divisi=="kasir") || (Auth::user()->divisi=="accounting") )             
              <li class="nav-item">
                <a href="{{url('pengajuan?flagz=2AB')}}" class="nav-link"> -->
                  <!-- <i class="nav-icon fas fa-archive icon-yellow "></i> -->
                  <!-- <p>Borongan Airblow</p>
                </a>
              </li>
              @endif
			  
			  @if ( (Auth::user()->divisi=="programmer") || (Auth::user()->divisi=="owner") || (Auth::user()->divisi=="assistant") || (Auth::user()->divisi=="kasir") || (Auth::user()->divisi=="accounting") )             
              <li class="nav-item">
                <a href="{{url('pengajuan?flagz=2PY')}}" class="nav-link"> -->
                  <!-- <i class="nav-icon fas fa-archive icon-yellow "></i> -->
                  <!-- <p>Borongan Phylon</p>
                </a>
              </li>
              @endif
			 
            </ul>			 
      </li> -->


<!--------------------------------------------------------------------------------------->
<li class="nav-header">LAPORAN</li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-shopping-basket icon-white"></i>
              <p>
                Master
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>

            <ul class="nav nav-treeview">
              <!-- IF check privilege & divisi -->
			  
              @if ( (Auth::user()->divisi=="programmer") || (Auth::user()->divisi=="owner") || (Auth::user()->divisi=="assistant") || (Auth::user()->divisi=="kasir") || (Auth::user()->divisi=="accounting") )             
              <li class="nav-item">
                <a href="{{url('raccount')}}" class="nav-link">
                  <!-- <i class="nav-icon fas  fa-shopping-basket icon-yellow "></i> -->
                  <p>Account</p>
                </a>
              </li>
              @endif
            </ul>			 
          </li>

		 <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-laptop icon-green"></i>
              <p>
                Transaksi
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>

            <ul class="nav nav-treeview">
              <!-- IF check privilege & divisi -->

              @if ( (Auth::user()->divisi=="programmer") || (Auth::user()->divisi=="owner") || (Auth::user()->divisi=="assistant") || (Auth::user()->divisi=="kasir") || (Auth::user()->divisi=="accounting") )             
              <li class="nav-item">
                <a href="{{url('rkas')}}" class="nav-link">
                  <i class="nav-icon fa fa-laptop icon-green "></i>
                  <p>Journal Kas</p>
                </a>
              </li>
              @endif

              @if ( (Auth::user()->divisi=="programmer") || (Auth::user()->divisi=="owner") || (Auth::user()->divisi=="assistant") || (Auth::user()->divisi=="kasir") || (Auth::user()->divisi=="accounting") )             
              <li class="nav-item">
                <a href="{{url('rbank')}}" class="nav-link">
                  <i class="nav-icon fa fa-laptop icon-yellow"></i>
                  <p>Journal Bank</p>
                </a>
              </li>
              @endif
			  
			  @if ( (Auth::user()->divisi=="programmer") || (Auth::user()->divisi=="owner") || (Auth::user()->divisi=="assistant") || (Auth::user()->divisi=="kasir") || (Auth::user()->divisi=="accounting") )             
              <li class="nav-item">
                <a href="{{url('rmemo')}}" class="nav-link">
                  <i class="nav-icon fa fa-laptop icon-purple"></i>
                  <p>Journal Memorial</p>
                </a>
              </li>
              @endif
			  
			  @if ( (Auth::user()->divisi=="programmer") || (Auth::user()->divisi=="owner") || (Auth::user()->divisi=="assistant") || (Auth::user()->divisi=="kasir") || (Auth::user()->divisi=="accounting") )             
              <li class="nav-item">
                <a href="{{url('rkasbankpertanggal')}}" class="nav-link">
                  <i class="nav-icon fa fa-laptop icon-red"></i>
                  <p>Kas Bank Per Tanggal</p>
                </a>
              </li>
              @endif
			  
			  @if ( (Auth::user()->divisi=="programmer") || (Auth::user()->divisi=="owner") || (Auth::user()->divisi=="assistant") || (Auth::user()->divisi=="kasir") || (Auth::user()->divisi=="accounting") )             
              <li class="nav-item">
                <a href="{{url('rnera')}}" class="nav-link">
                  <i class="nav-icon fa fa-laptop icon-blue"></i>
                  <p>Laporan Neraca</p>
                </a>
              </li>
              @endif
			  
			  @if ( (Auth::user()->divisi=="programmer") || (Auth::user()->divisi=="owner") || (Auth::user()->divisi=="assistant") || (Auth::user()->divisi=="kasir") || (Auth::user()->divisi=="accounting") )             
              <li class="nav-item">
                <a href="{{url('rrl')}}" class="nav-link">
                  <i class="nav-icon fa fa-laptop icon-pink"></i>
                  <p>Laporan Rugi Laba</p>
                </a>
              </li>
              @endif

              @if ( (Auth::user()->divisi=="programmer") || (Auth::user()->divisi=="owner") || (Auth::user()->divisi=="assistant") || (Auth::user()->divisi=="kasir") || (Auth::user()->divisi=="accounting") )             
              <li class="nav-item">
                <a href="{{url('rrltahun')}}" class="nav-link">
                  <i class="nav-icon fa fa-laptop icon-pink"></i>
                  <p>Laporan Rugi Laba Tahunan</p>
                </a>
              </li>
              @endif

			  @if ( (Auth::user()->divisi=="programmer") || (Auth::user()->divisi=="owner") || (Auth::user()->divisi=="assistant") || (Auth::user()->divisi=="kasir") || (Auth::user()->divisi=="accounting") )             
              <li class="nav-item">
                <a href="{{url('rmutasi')}}" class="nav-link">
                  <i class="nav-icon fa fa-laptop icon-pink"></i>
                  <p>Laporan Mutasi</p>
                </a>
              </li>
              @endif

            @if ( (Auth::user()->divisi=="programmer") || (Auth::user()->divisi=="owner") || (Auth::user()->divisi=="assistant") || (Auth::user()->divisi=="kasir") || (Auth::user()->divisi=="accounting") )             
            <li class="nav-item">
              <a href="{{url('rratio')}}" class="nav-link">
                <i class="nav-icon fa fa-laptop icon-pink"></i>
                <p>Laporan Ratio</p>
              </a>
            </li>
            @endif


            @if ( (Auth::user()->divisi=="programmer") || (Auth::user()->divisi=="owner") || (Auth::user()->divisi=="assistant") || (Auth::user()->divisi=="kasir") || (Auth::user()->divisi=="accounting") )             
            <li class="nav-item">
              <a href="{{url('rbiaya')}}" class="nav-link">
                <i class="nav-icon fa fa-laptop icon-pink"></i>
                <p>Laporan Biaya</p>
              </a>
            </li>
            @endif

            @if ( (Auth::user()->divisi=="programmer") || (Auth::user()->divisi=="owner") || (Auth::user()->divisi=="assistant") || (Auth::user()->divisi=="kasir") || (Auth::user()->divisi=="accounting") )             
            <li class="nav-item">
              <a href="{{url('rbuku')}}" class="nav-link">
                <i class="nav-icon fa fa-laptop icon-pink"></i>
                <p>Laporan Buku Besar</p>
              </a>
            </li>
            @endif

            @if ( (Auth::user()->divisi=="programmer") || (Auth::user()->divisi=="owner") || (Auth::user()->divisi=="assistant") || (Auth::user()->divisi=="kasir") || (Auth::user()->divisi=="accounting") )             
            <li class="nav-item">
              <a href="{{url('rcashflow')}}" class="nav-link">
                <i class="nav-icon fa fa-laptop icon-pink"></i>
                <p>Laporan Cashflow</p>
              </a>
            </li>
            @endif

			  @if ( (Auth::user()->divisi=="programmer") || (Auth::user()->divisi=="owner") || (Auth::user()->divisi=="assistant") || (Auth::user()->divisi=="kasir") || (Auth::user()->divisi=="accounting") )             
              <li class="nav-item">
                <a href="{{url('rcekbuktilubang')}}" class="nav-link">
                  <i class="nav-icon fa fa-laptop icon-black"></i>
                  <p>Cek Bukti Lubang</p>
                </a>
              </li>
              @endif

        @if ( (Auth::user()->divisi=="programmer") || (Auth::user()->divisi=="owner") || (Auth::user()->divisi=="assistant") || (Auth::user()->divisi=="kasir") || (Auth::user()->divisi=="accounting") )             
            <li class="nav-item">
              <a href="{{url('ranalisa')}}" class="nav-link">
                <i class="nav-icon fa fa-laptop icon-grey"></i>
                <p>Laporan Analisa Bahan</p>
              </a>
            </li>
        @endif
			
        @if ( (Auth::user()->divisi=="programmer") || (Auth::user()->divisi=="owner") || (Auth::user()->divisi=="assistant") || (Auth::user()->divisi=="kasir") || (Auth::user()->divisi=="accounting") )             
            <li class="nav-item">
              <a href="{{url('rkaskeluarpendekpertanggal')}}" class="nav-link">
                <i class="nav-icon fa fa-laptop icon-blue"></i>
                <p>Laporan Kas Keluar Pendek Per Tanggal</p>
              </a>
            </li>
        @endif

            </ul>			 
          </li>
<!--------------------------------------------------------------------------------------->

<li class="nav-header">UTILITY</li>


<!---------- griff2 ------------------------------------------------------------->

      <li class="nav-item">
        <a href="#" class="nav-link">
          <i class="nav-icon fa fa-bug icon-pink"></i>
          <p>
            Oper Kas / Bank
            <i class="right fas fa-angle-left"></i>
          </p>
        </a>

        <ul class="nav nav-treeview">
          <!-- IF check privilege & divisi -->
    
          @if ( (Auth::user()->divisi=="programmer") || (Auth::user()->divisi=="owner") || (Auth::user()->divisi=="assistant") || (Auth::user()->divisi=="kasir") || (Auth::user()->divisi=="accounting") )             
          <li class="nav-item">
            <a href="{{url('roperbbmbbk')}}" class="nav-link">
              <!-- <i class="nav-icon fas fa-archive icon-white "></i> -->
              <p>BBM/BBK</p>
            </a>
          </li>
          @endif
		  
          @if ( (Auth::user()->divisi=="programmer") || (Auth::user()->divisi=="owner") || (Auth::user()->divisi=="assistant") || (Auth::user()->divisi=="kasir") || (Auth::user()->divisi=="accounting") )             
          <li class="nav-item">
            <a href="{{url('roperbkmbkk')}}" class="nav-link">
              <!-- <i class="nav-icon fas fa-archive icon-white "></i> -->
              <p>BKM/BKK</p>
            </a>
          </li>
          @endif

        </ul>			 
      </li>


<!--------------------------------------------------------------------------------------->

		<li class="nav-item">
			@if ( (Auth::user()->divisi=="programmer") || (Auth::user()->divisi=="owner") || (Auth::user()->divisi=="assistant") || (Auth::user()->divisi=="kasir") || (Auth::user()->divisi=="accounting") )             
			<li class="nav-item">
			<a href="{{url('sup')}}" class="nav-link">
				<i class="nav-icon fa fa-child icon-grey "></i>
				<p>No Rekening Supplier</p>
			</a>
			</li>
			@endif
			
			
			@if ( (Auth::user()->divisi=="programmer") || (Auth::user()->divisi=="owner") || (Auth::user()->divisi=="assistant") || (Auth::user()->divisi=="kasir") || (Auth::user()->divisi=="accounting") )             
              <li class="nav-item">
                <a href="{{url('rsaldobank')}}" class="nav-link">
                  <i class="nav-icon fa fa-laptop icon-blue"></i>
                  <p>Isi Saldo Bank</p>
                </a>
              </li>
              @endif

			@if ( (Auth::user()->divisi=="programmer") || (Auth::user()->divisi=="owner") || (Auth::user()->divisi=="assistant") || (Auth::user()->divisi=="kasir") || (Auth::user()->divisi=="accounting") )             
              <li class="nav-item">
                <a href="{{url('rsaldokas')}}" class="nav-link">
                  <i class="nav-icon fa fa-laptop icon-blue"></i>
                  <p>Isi Saldo Kas</p>
                </a>
              </li>
            @endif

			@if ( (Auth::user()->divisi=="programmer") || (Auth::user()->divisi=="owner") || (Auth::user()->divisi=="assistant") || (Auth::user()->divisi=="kasir") || (Auth::user()->divisi=="accounting") )             
              <li class="nav-item">
                <a href="{{url('rlihatpnpb')}}" class="nav-link">
                  <i class="nav-icon fa fa-laptop icon-blue"></i>
                  <p>Lihat PB PN</p>
                </a>
              </li>
            @endif

			
		</li>
        </ul>
      </nav>
    </div>
  </aside>