<?php

use Illuminate\Support\Facades\Route;

// Dashboard
Route::get('/', 'App\Http\Controllers\DashboardController@index')->middleware(['auth']);
Route::get('/dashboard', 'App\Http\Controllers\DashboardController@index')->middleware(['auth']);
// Chart Dashboard
Route::get('/chart', 'App\Http\Controllers\ChartController@chart')->middleware(['auth'])->middleware(['checkDivisi:programmer,owner,assistant,kasir']);
Route::get('/cheatsheet', 'App\Http\Controllers\CheatsheetController@index')->middleware(['auth'])->middleware(['checkDivisi:programmer,kasir']);
//User Edit
Route::get('/profile', 'App\Http\Controllers\ProfileController@index')->middleware(['auth']);
Route::post('/profile/update', 'App\Http\Controllers\ProfileController@update')->middleware(['auth']);

// Periode
Route::post('/periode', 'App\Http\Controllers\PeriodeController@index')->middleware(['auth'])->name('periode');

// Operational Account

// Master Account
Route::get('/account', 'App\Http\Controllers\FMaster\AccountController@index')->middleware(['auth'])->name('account');
Route::post('/account/store', 'App\Http\Controllers\FMaster\AccountController@store')->middleware(['auth'])->name('account/store');
Route::get('/account/create', 'App\Http\Controllers\FMaster\AccountController@create')->middleware(['auth'])->name('account/create');
Route::get('/raccount', 'App\Http\Controllers\FReport\RAccountController@report')->middleware(['auth'])->name('raccount');
    // GET ACCOUNT
    Route::get('/get-account', 'App\Http\Controllers\FMaster\AccountController@getAccount')->middleware(['auth'])->name('get-account');
    Route::get('/account/browse', 'App\Http\Controllers\FMaster\AccountController@browse')->middleware(['auth'])->name('account/browse');
    Route::get('/account/browsecash', 'App\Http\Controllers\FMaster\AccountController@browsecash')->middleware(['auth'])->name('account/browsecash');
    Route::get('/account/browsebank', 'App\Http\Controllers\FMaster\AccountController@browsebank')->middleware(['auth'])->name('account/browsebank');
	Route::get('/account/browsehut', 'App\Http\Controllers\FMaster\AccountController@browsehut')->middleware(['auth'])->name('account/browsehut');
    Route::get('/account/browsecashbank', 'App\Http\Controllers\FMaster\AccountController@browsecashbank')->middleware(['auth'])->name('account/browsecashbank');
    Route::get('/account/browseallacc', 'App\Http\Controllers\FMaster\AccountController@browseallacc')->middleware(['auth'])->name('account/browseallacc');


    Route::get('/get-account-report', 'App\Http\Controllers\FReport\RAccountController@getAccountReport')->middleware(['auth'])->name('get-account-report');
    Route::post('/jasper-account-report', 'App\Http\Controllers\FReport\RAccountController@jasperAccountReport')->middleware(['auth']);
    Route::get('account/cekacc', 'App\Http\Controllers\FMaster\AccountController@cekacc')->middleware(['auth']);
    Route::get('account/browseKel', 'App\Http\Controllers\FMaster\AccountController@browseKel')->middleware(['auth']);
// Dynamic Account
Route::get('/account/show/{account}', 'App\Http\Controllers\FMaster\AccountController@show')->middleware(['auth'])->name('accountid');
Route::get('/account/edit', 'App\Http\Controllers\FMaster\AccountController@edit')->middleware(['auth'])->name('account.edit');
Route::post('/account/update/{account}', 'App\Http\Controllers\FMaster\AccountController@update')->middleware(['auth'])->name('account.update');
Route::get('/account/delete/{account}', 'App\Http\Controllers\FMaster\AccountController@destroy')->middleware(['auth'])->name('account.delete');



///////////////////////////////////////////////

// Master Suplier (FMaster)
Route::get('/sup', 'App\Http\Controllers\FMaster\SupController@index')->middleware(['auth'])->name('sup');
Route::post('/sup/store', 'App\Http\Controllers\FMaster\SupController@store')->middleware(['auth'])->name('sup/store');
Route::get('/sup/create', 'App\Http\Controllers\FMaster\SupController@create')->middleware(['auth'])->name('sup/create');
Route::get('/rsup', 'App\Http\Controllers\FReport\RSupController@report')->middleware(['auth'])->name('rsup');
    // GET SUP
    Route::get('/get-sup', 'App\Http\Controllers\FMaster\SupController@getSup')->middleware(['auth'])->name('get-sup');
    Route::get('/sup/browse', 'App\Http\Controllers\FMaster\SupController@browse')->middleware(['auth'])->name('sup/browse');
    Route::get('/get-sup-report', 'App\Http\Controllers\FReport\RSupController@getSupReport')->middleware(['auth'])->name('get-sup-report');
    Route::post('/jasper-sup-report', 'App\Http\Controllers\FReport\RSupController@jasperSupReport')->middleware(['auth'])->name('jasper-sup-report');
    Route::get('sup/ceksup', 'App\Http\Controllers\FMaster\SupController@ceksup')->middleware(['auth']);
	Route::get('sup/get-select-kodes', 'App\Http\Controllers\FMaster\SupController@getSelectKodes')->middleware(['auth']);
// Dynamic Suplier
Route::get('/sup/show/{sup}', 'App\Http\Controllers\FMaster\SupController@show')->middleware(['auth'])->name('supid');
Route::get('/sup/edit/{sup}', 'App\Http\Controllers\FMaster\SupController@edit')->middleware(['auth'])->name('sup.edit');
Route::post('/sup/update/{sup}', 'App\Http\Controllers\FMaster\SupController@update')->middleware(['auth'])->name('sup.update');
Route::get('/sup/delete/{sup}', 'App\Http\Controllers\FMaster\SupController@destroy')->middleware(['auth'])->name('sup.delete');


////////////////////////////////////////////////////////////

// Operational Memo
Route::get('/memo', 'App\Http\Controllers\FTransaksi\MemoController@index')->middleware(['auth'])->name('memo');
Route::post('/memo/store', 'App\Http\Controllers\FTransaksi\MemoController@store')->middleware(['auth'])->name('memo/store');
Route::get('/memo/create', 'App\Http\Controllers\FTransaksi\MemoController@create')->middleware(['auth'])->name('memo/create');
Route::get('/memo/edit', 'App\Http\Controllers\FTransaksi\MemoController@edit')->middleware(['auth'])->name('memo/edit');
Route::post('/memo/update/{memo}', 'App\Http\Controllers\FTransaksi\MemoController@update')->middleware(['auth'])->middleware(['auth'])->name('memo/update');
Route::get('/memo/delete/{memo}', 'App\Http\Controllers\FTransaksi\MemoController@destroy')->middleware(['auth'])->name('memo.delete');
Route::get('/get-memo', 'App\Http\Controllers\FTransaksi\MemoController@getMemo')->middleware(['auth'])->name('get-memo');
Route::get('/rmemo', 'App\Http\Controllers\FReport\RMemoController@report')->middleware(['auth'])->name('rmemo');
Route::get('/get-memo-report', 'App\Http\Controllers\FReport\RMemoController@getMemoReport')->middleware(['auth'])->name('get-memo-report');

// Operational Kas Masuk/Kas Keluar
Route::get('/kas', 'App\Http\Controllers\FTransaksi\KasController@index')->middleware(['auth'])->name('kas');
Route::post('/kas/store', 'App\Http\Controllers\FTransaksi\KasController@store')->middleware(['auth'])->name('kas/store');
Route::get('/kas/create', 'App\Http\Controllers\FTransaksi\KasController@create')->middleware(['auth'])->name('kas/create');
Route::get('/kas/edit', 'App\Http\Controllers\FTransaksi\KasController@edit')->middleware(['auth'])->name('kas/edit');
Route::post('/kas/update/{kas}', 'App\Http\Controllers\FTransaksi\KasController@update')->middleware(['auth'])->middleware(['auth'])->name('kas/update');
Route::get('/get-kas', 'App\Http\Controllers\FTransaksi\KasController@getKas')->middleware(['auth'])->name('get-kas');
Route::get('/rkas', 'App\Http\Controllers\FReport\RKasController@report')->middleware(['auth'])->name('rkas');
Route::get('/get-kas-report', 'App\Http\Controllers\FReport\RKasController@getKasReport')->middleware(['auth'])->name('get-kas-report');
Route::get('/kas/delete/{kas}', 'App\Http\Controllers\FTransaksi\KasController@destroy')->middleware(['auth'])->name('kas.delete');
Route::get('/kas/cari', 'App\Http\Controllers\FTransaksi\KasController@cari')->middleware(['auth'])->name('kas/cari');
Route::get('/kas/cek_bukti', 'App\Http\Controllers\FTransaksi\KasController@cek_bukti')->middleware(['auth'])->name('kas/cek_bukti');


Route::get('/jasper-kas-trans/{kas:NO_ID}', 'App\Http\Controllers\FTransaksi\KasController@jasperKasTrans')->middleware(['auth']);

Route::get('/kas/browsebkk1', 'App\Http\Controllers\FTransaksi\KasController@browsebkk1')->middleware(['auth'])->name('kas/browsebkk1');
Route::get('/kas/browsebkk2', 'App\Http\Controllers\FTransaksi\KasController@browsebkk2')->middleware(['auth'])->name('kas/browsebkk2');
Route::get('/kas/browse_kas_pms', 'App\Http\Controllers\FTransaksi\KasController@browse_kas_pms')->middleware(['auth'])->name('kas/browse_kas_pms');
Route::post('/kas/storedatabkk', 'App\Http\Controllers\FTransaksi\KasController@storedatabkk')->middleware(['auth'])->name('kas/storedatabkk');

Route::get('/kas/print/{kas:NO_ID}', 'App\Http\Controllers\FTransaksi\KasController@cetak')->middleware(['auth']);
Route::get('/kas/print2/{kas:NO_ID}', 'App\Http\Controllers\FTransaksi\KasController@cetak2')->middleware(['auth']);

// Operational Bank Masuk/ Bank Keluar
Route::get('/bank', 'App\Http\Controllers\FTransaksi\BankController@index')->middleware(['auth'])->name('bank');
Route::post('/bank/store', 'App\Http\Controllers\FTransaksi\BankController@store')->middleware(['auth'])->name('bank/store');
Route::get('/bank/create', 'App\Http\Controllers\FTransaksi\BankController@create')->middleware(['auth'])->name('bank/create');
Route::get('/bank/edit', 'App\Http\Controllers\FTransaksi\BankController@edit')->middleware(['auth'])->middleware(['checkDivisi:programmer,gudang,assistant,kasir'])->name('bank.edit');
Route::post('/bank/update/{bank}', 'App\Http\Controllers\FTransaksi\BankController@update')->middleware(['auth'])->middleware(['checkDivisi:programmer,gudang,assistant,kasir'])->name('bank.update');
Route::get('/get-bank', 'App\Http\Controllers\FTransaksi\BankController@getBank')->middleware(['auth'])->name('get-bank');
Route::get('/rbank', 'App\Http\Controllers\FReport\RBankController@report')->middleware(['auth'])->name('rbank');
Route::get('/get-bank-report', 'App\Http\Controllers\FReport\RBankController@getBankReport')->middleware(['auth'])->name('get-bank-report');
Route::get('/bank/delete/{bank}', 'App\Http\Controllers\FTransaksi\BankController@destroy')->middleware(['auth'])->name('bank.delete');
Route::get('/bank/cari', 'App\Http\Controllers\FTransaksi\BankController@cari')->middleware(['auth'])->name('bank/cari');
Route::get('/bank/cek_bukti', 'App\Http\Controllers\FTransaksi\BankController@cek_bukti')->middleware(['auth'])->name('bank/cek_bukti');

Route::get('/bank/print/{bank:NO_ID}', 'App\Http\Controllers\FTransaksi\BankController@cetak')->middleware(['auth']);
Route::get('/bank/print2/{bank:NO_ID}', 'App\Http\Controllers\FTransaksi\BankController@cetak2')->middleware(['auth']);

// Operational Pengajuan Harga
Route::get('/pengajuan', 'App\Http\Controllers\OTransaksi\PengajuanController@index')->middleware(['auth'])->name('pengajuan');
Route::post('/pengajuan/store', 'App\Http\Controllers\OTransaksi\PengajuanController@store')->middleware(['auth'])->name('pengajuan/store');
Route::get('/pengajuan/create', 'App\Http\Controllers\OTransaksi\PengajuanController@create')->middleware(['auth'])->name('pengajuan/create');
Route::get('/pengajuan/edit', 'App\Http\Controllers\OTransaksi\PengajuanController@edit')->middleware(['auth'])->name('pengajuan/edit');
Route::post('/pengajuan/update/{pengajuan}', 'App\Http\Controllers\OTransaksi\PengajuanController@update')->middleware(['auth'])->middleware(['auth'])->name('pengajuan/update');
Route::get('/get-pengajuan', 'App\Http\Controllers\OTransaksi\PengajuanController@getPengajuan')->middleware(['auth'])->name('get-pengajuan');
Route::get('/rpengajuan', 'App\Http\Controllers\OReport\RPengajuanController@report')->middleware(['auth'])->name('rpengajuan');
Route::get('/get-pengajuan-report', 'App\Http\Controllers\OReport\RPengajuanController@getPengajuanReport')->middleware(['auth'])->name('get-pengajuan-report');
Route::get('/pengajuan/delete/{pengajuan}', 'App\Http\Controllers\OTransaksi\PengajuanController@destroy')->middleware(['auth'])->name('pengajuan.delete');
Route::get('/pengajuan/validasi1/{pengajuan}', 'App\Http\Controllers\OTransaksi\PengajuanController@validasi1')->middleware(['auth'])->name('pengajuan.validasi1');
Route::get('/pengajuan/validasi2/{pengajuan}', 'App\Http\Controllers\OTransaksi\PengajuanController@validasi2')->middleware(['auth'])->name('pengajuan.validasi2');
Route::get('/pengajuan/validasi3/{pengajuan}', 'App\Http\Controllers\OTransaksi\PengajuanController@validasi3')->middleware(['auth'])->name('pengajuan.validasi3');
Route::get('/pengajuan/validasi4/{pengajuan}', 'App\Http\Controllers\OTransaksi\PengajuanController@validasi4')->middleware(['auth'])->name('pengajuan.validasi4');
Route::get('/pengajuan/validasi5/{pengajuan}', 'App\Http\Controllers\OTransaksi\PengajuanController@validasi5')->middleware(['auth'])->name('pengajuan.validasi5');


// Operasional Data BKK

Route::get('/wila/browsewilayah', 'App\Http\Controllers\FMaster\WilaController@browsewilayah')->middleware(['auth'])->name('wila/browsewilayah');


// Report Kas Bank Pertanggal
Route::get('/rkasbankpertanggal', 'App\Http\Controllers\FReport\RKasBankPertanggalController@report')->middleware(['auth'])->name('rkasbankpertanggal');
Route::post('/rkasbankpertanggal/jasper-kasbankpertanggal-report', 'App\Http\Controllers\FReport\RKasBankPertanggalController@jasperKasBankPertanggalReport')->middleware(['auth']);

// Report Kas Keluar Pendek Pertanggal
Route::get('/rkaskeluarpendekpertanggal', 'App\Http\Controllers\FReport\RKasKeluarPendekPertanggalController@report')->middleware(['auth'])->name('rkaskeluarpendekpertanggal');
Route::post('/rkaskeluarpendekpertanggal/jasper-kaskeluarpendekpertanggal-report', 'App\Http\Controllers\FReport\RKasKeluarPendekPertanggalController@jasperKasKeluarPendekPertanggalReport')->middleware(['auth']);

// Report Memo
Route::get('/rmemo', 'App\Http\Controllers\FReport\RMemoController@report')->middleware(['auth'])->name('rmemo');
Route::post('/rmemo/jasper-memo-report', 'App\Http\Controllers\FReport\RMemoController@jasperMemoReport')->middleware(['auth']);

// Report Bank
Route::get('/rbank', 'App\Http\Controllers\FReport\RBankController@report')->middleware(['auth'])->name('rbank');
Route::post('/rbank/jasper-bank-report', 'App\Http\Controllers\FReport\RBankController@jasperBankReport')->middleware(['auth']);

// Report Kas
Route::get('/rkas', 'App\Http\Controllers\FReport\RKasController@report')->middleware(['auth'])->name('rkas');
Route::post('/rkas/jasper-kas-report', 'App\Http\Controllers\FReport\RKasController@jasperKasReport')->middleware(['auth']);

// Report Neraca
Route::get('/rnera', 'App\Http\Controllers\FReport\RNeraController@report')->middleware(['auth'])->name('rnera');
Route::get('/get-nera-report', 'App\Http\Controllers\FReport\RNeraController@getNeraReport')->middleware(['auth'])->name('get-nera-report');
Route::post('/jasper-nera-report', 'App\Http\Controllers\FReport\RNeraController@jasperNeraReport')->middleware(['auth']);

// Report Biaya
Route::get('/rbiaya', 'App\Http\Controllers\FReport\RBiayaController@report')->middleware(['auth'])->name('rbiaya');
Route::get('/get-biaya-report', 'App\Http\Controllers\FReport\RBiayaController@getBiayaReport')->middleware(['auth'])->name('get-biaya-report');
Route::post('/jasper-biaya-report', 'App\Http\Controllers\FReport\RBiayaController@jasperBiayaReport')->middleware(['auth']);

// Report Rugi Laba
Route::get('/rrl', 'App\Http\Controllers\FReport\RRlController@report')->middleware(['auth'])->name('rrl');
Route::get('/get-rl-report', 'App\Http\Controllers\FReport\RRlController@getRlReport')->middleware(['auth'])->name('get-rl-report');
Route::post('/jasper-rl-report', 'App\Http\Controllers\FReport\RRlController@jasperRlReport')->middleware(['auth']);

// Report Rugi Laba Tahunan
Route::get('/rrltahun', 'App\Http\Controllers\FReport\RRltahunController@report')->middleware(['auth'])->name('rrltahun');
Route::get('/get-rltahun-report', 'App\Http\Controllers\FReport\RRltahunController@getRltahunReport')->middleware(['auth'])->name('get-rltahun-report');
Route::post('/jasper-rltahun-report', 'App\Http\Controllers\FReport\RRltahunController@jasperRltahunReport')->middleware(['auth']);

// Report Isi Buku Besat
Route::get('/rbuku', 'App\Http\Controllers\FReport\RBukuController@report')->middleware(['auth'])->name('rbuku');
Route::post('/rbuku/jasper-buku-report', 'App\Http\Controllers\FReport\RBukuController@jasperBukuReport')->middleware(['auth']);

// Report Isi Buku Besat
Route::get('/rratio', 'App\Http\Controllers\FReport\RRatioController@report')->middleware(['auth'])->name('rratio');
Route::post('/rratio/jasper-ratio-report', 'App\Http\Controllers\FReport\RRatioController@jasperRatioReport')->middleware(['auth']);

// Report Isi Buku Besat
Route::get('/rcashflow', 'App\Http\Controllers\FReport\RCashflowController@report')->middleware(['auth'])->name('rcashflow');
Route::post('/rcashflow/jasper-cashflow-report', 'App\Http\Controllers\FReport\RCashflowController@jasperCashflowReport')->middleware(['auth']);

// Report Cek Bukti Lubang
Route::get('/rcekbuktilubang', 'App\Http\Controllers\FReport\RCekBuktiLubangController@report')->middleware(['auth'])->name('rcekbuktilubang');
Route::post('/rcekbuktilubang/jasper-cekbuktilubang-report', 'App\Http\Controllers\FReport\RCekBuktiLubangController@jasperCekBuktiLubangReport')->middleware(['auth']);

// Report Anlisa Bahan
Route::get('/ranalisa', 'App\Http\Controllers\FReport\RAnalisaController@report')->middleware(['auth'])->name('ranalisa');
Route::post('/ranalisa/jasper-analisa-report', 'App\Http\Controllers\FReport\RAnalisaController@jasperAnalisaReport')->middleware(['auth']);

// Report Mutasi
Route::get('/rmutasi', 'App\Http\Controllers\FReport\RMutasiController@report')->middleware(['auth'])->name('rmutasi');
Route::post('/rmutasi/jasper-mutasi-report', 'App\Http\Controllers\FReport\RMutasiController@jasperMutasiReport')->middleware(['auth']);

// Report Isi Saldo Bank
Route::get('/rsaldobank', 'App\Http\Controllers\FReport\RSaldoBankController@report')->middleware(['auth'])->name('rsaldobank');
Route::post('/rsaldobank/jasper-saldobank-report', 'App\Http\Controllers\FReport\RSaldoBankController@jasperSaldoBankReport')->middleware(['auth']);

// Report Isi Saldo Kas
Route::get('/rsaldokas', 'App\Http\Controllers\FReport\RSaldoKasController@report')->middleware(['auth'])->name('rsaldokas');
Route::post('/rsaldokas/jasper-saldokas-report', 'App\Http\Controllers\FReport\RSaldoKasController@jasperSaldoKasReport')->middleware(['auth']);

// Report Lihat PB PN
Route::get('/rlihatpnpb', 'App\Http\Controllers\FReport\RLihatpnpbController@report')->middleware(['auth'])->name('rlihatpnpb');
Route::post('/rlihatpnpb/jasper-lihatpnpb-report', 'App\Http\Controllers\FReport\RLihatpnpbController@jasperLihatpnpbReport')->middleware(['auth']);

// Oper Bank 
Route::get('/roperbbmbbk', 'App\Http\Controllers\OReport\ROperbbmbbkController@report')->middleware(['auth'])->name('roperbbmbbk');
Route::post('/roperbbmbbk/jasper-operbbmbbk-report', 'App\Http\Controllers\OReport\ROperbbmbbkController@jasperOperbbmbbkReport')->middleware(['auth']);

// Oper Kas
Route::get('/roperbkmbkk', 'App\Http\Controllers\OReport\ROperbkmbkkController@report')->middleware(['auth'])->name('roperbkmbkk');
Route::post('/roperbkmbkk/jasper-operbkmbkk-report', 'App\Http\Controllers\OReport\ROperbkmbkkController@jasperOperbkmbkkReport')->middleware(['auth']);

// Oper Bank 
Route::get('/roperbbmbbk_1nomor', 'App\Http\Controllers\OReport\ROperbbmbbk_1nomorController@report')->middleware(['auth'])->name('roperbbmbbk_1nomor');
Route::post('/roperbbmbbk_1nomor/jasper-operbbmbbk_1nomor-report', 'App\Http\Controllers\OReport\ROperbbmbbk_1nomorController@jasperOperbbmbbk_1nomorReport')->middleware(['auth']);

// Oper Kas
Route::get('/roperbkmbkk_1nomor', 'App\Http\Controllers\OReport\ROperbkmbkk_1nomorController@report')->middleware(['auth'])->name('roperbkmbkk_1nomor');
Route::post('/roperbkmbkk_1nomor/jasper-operbkmbkk_1nomor-report', 'App\Http\Controllers\OReport\ROperbkmbkk_1nomorController@jasperOperbkmbkk_1nomorReport')->middleware(['auth']);


// Operational Cek BG
Route::get('/bg', 'App\Http\Controllers\OTransaksi\BgController@index')->middleware(['auth'])->name('bg');
Route::post('/bg/store', 'App\Http\Controllers\OTransaksi\BgController@store')->middleware(['auth'])->name('bg/store');
Route::get('/bg/create', 'App\Http\Controllers\OTransaksi\BgController@create')->middleware(['auth'])->name('bg/create');
Route::get('/bg/edit/{bg}', 'App\Http\Controllers\OTransaksi\BgController@edit')->middleware(['auth'])->middleware(['checkDivisi:programmer,gudang,assistant,kasir'])->name('bg.edit');
Route::get('/bg/edit', 'App\Http\Controllers\OTransaksi\BgController@edit')->middleware(['auth'])->middleware(['checkDivisi:programmer,gudang,assistant,kasir'])->name('bg.edit');
Route::post('/bg/update/{bg}', 'App\Http\Controllers\OTransaksi\BgController@update')->middleware(['auth'])->middleware(['checkDivisi:programmer,gudang,assistant,kasir'])->name('bg.update');
Route::get('/get-bg', 'App\Http\Controllers\OTransaksi\BgController@getBg')->middleware(['auth'])->name('get-bg');
Route::get('/bg/print/{bg:NO_ID}', 'App\Http\Controllers\OTransaksi\BgController@cetak')->middleware(['auth']);



// Operational Form Slip
Route::get('/slip', 'App\Http\Controllers\OTransaksi\SlipController@index')->middleware(['auth'])->name('slip');
Route::post('/slip/store', 'App\Http\Controllers\OTransaksi\SlipController@store')->middleware(['auth'])->name('slip/store');
Route::get('/slip/create', 'App\Http\Controllers\OTransaksi\SlipController@create')->middleware(['auth'])->name('slip/create');
Route::get('/slip/edit/{slip}', 'App\Http\Controllers\OTransaksi\SlipController@edit')->middleware(['auth'])->middleware(['checkDivisi:programmer,gudang,assistant,kasir'])->name('slip.edit');
Route::post('/slip/update/{slip}', 'App\Http\Controllers\OTransaksi\SlipController@update')->middleware(['auth'])->middleware(['checkDivisi:programmer,gudang,assistant,kasir'])->name('slip.update');
Route::get('/get-slip', 'App\Http\Controllers\OTransaksi\SlipController@getSlip')->middleware(['auth'])->name('get-slip');
Route::get('/slip/print/{slip:NO_ID}', 'App\Http\Controllers\OTransaksi\SlipController@cetak')->middleware(['auth']);


// Operational Pemasaran Baru untuk Slip
Route::get('/wila', 'App\Http\Controllers\FMaster\WilaController@index')->middleware(['auth'])->name('wila');
Route::post('/wila/store', 'App\Http\Controllers\FMaster\WilaController@store')->middleware(['auth'])->name('wila/store');
Route::get('/wila/browse', 'App\Http\Controllers\FMaster\WilaController@browse')->middleware(['auth'])->name('wila/browse');
Route::get('/wila/create', 'App\Http\Controllers\FMaster\WilaController@create')->middleware(['auth'])->name('wila/create');
Route::get('/wila/edit/{wila}', 'App\Http\Controllers\FMaster\WilaController@edit')->middleware(['auth'])->middleware(['checkDivisi:programmer,gudang,assistant,kasir'])->name('wila.edit');
Route::post('/wila/update/{wila}', 'App\Http\Controllers\FMaster\WilaController@update')->middleware(['auth'])->middleware(['checkDivisi:programmer,gudang,assistant,kasir'])->name('wila.update');
Route::get('/get-wila', 'App\Http\Controllers\FMaster\WilaController@getWila')->middleware(['auth'])->name('get-wila');
Route::get('wila/cek', 'App\Http\Controllers\FMaster\WilaController@cek')->middleware(['auth']);




require __DIR__.'/auth.php';