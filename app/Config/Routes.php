<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
// $routes->get('/', 'Home::index');

$routes->get('/login', 'Login');
$routes->post('/login/auth', 'Login::auth');
$routes->get('/recover', 'Login::recover');
$routes->post('/login/reset', 'Login::reset');
$routes->get('/newuser', 'Login::newuser');
$routes->post('/login/createuser', 'Login::createuser');
$routes->get('/logout', 'Login::logout');

$routes->get('/', 'Home::index', ['filter' => 'auth']);
$routes->get('/profile', 'Home::profilpegawai', ['filter' => 'auth']);
$routes->get('/sandi', 'Home::sandi', ['filter' => 'auth']);
$routes->post('/savepass', 'Home::savepass', ['filter' => 'auth']);
$routes->get('/logdata', 'Home::logdata', ['filter' => 'auth']);
$routes->get('/lang/{locale}', 'Home::bahasa');
$routes->get('/modalnav', 'Home::modaldata');

// Admin____________________________________________________________________________________________________________________________
$routes->group('konfigurasi', ['filter' => 'auth'],  function ($routes) {
    $routes->get('/', 'file\admin\Konfigurasi::index');
    $routes->get('modalkoreksi', 'file\admin\Konfigurasi::modaldata');
    $routes->post('okdata', 'file\admin\Konfigurasi::okdata');
    $routes->get('tabdata', 'file\admin\Konfigurasi::tabeldata');
});
$routes->group('role', ['filter' => 'auth'],  function ($routes) {
    $routes->get('/', 'file\admin\Role::index');
    $routes->get('input', 'file\admin\Role::crany');
    $routes->get('input/(:any)', 'file\admin\Role::showdata/$1');
    $routes->post('save', 'file\admin\Role::savedata');
});
$routes->group('user', ['filter' => 'auth'],  function ($routes) {
    $routes->get('/', 'file\admin\User::index');
    $routes->get('input/(:any)', 'file\admin\User::showdata/$1');
    $routes->post('save', 'file\admin\User::savedata');
    $routes->post('delete', 'file\admin\User::deletedata');
    $routes->post('atasan', 'extra\Loadfile::loaduser');
});
$routes->group('loguser', ['filter' => 'auth'],  function ($routes) {
    $routes->get('/', 'file\admin\Loguser::index');
    $routes->get('tablog', 'file\admin\Loguser::tabellog');
});
$routes->group('ulangsandi', ['filter' => 'auth'],  function ($routes) {
    $routes->get('/', 'file\admin\Resetsandi::index');
    $routes->get('tabdata', 'file\admin\Resetsandi::tabeldata');
    $routes->post('resetdata', 'file\admin\Resetsandi::resetdata');
});

// File____________________________________________________________________________________________________________________________
$routes->group('perusahaan', ['filter' => 'auth'],  function ($routes) {
    $routes->get('/', 'file\deklarasi\Perusahaan::index');
    $routes->get('input', 'file\deklarasi\Perusahaan::crany');
    $routes->get('input/(:any)', 'file\deklarasi\Perusahaan::showdata/$1');
    $routes->post('save', 'file\deklarasi\Perusahaan::savedata');
    // $routes->delete('delete/(:any)', 'file\deklarasi\Perusahaan::deletedata/$1');
    $routes->get('tablampir', 'extra\Lampiran::tabellampiran');
    $routes->get('modallampir', 'extra\Lampiran::modallampiran');
    $routes->post('unduhlampir', 'extra\Lampiran::downloadlampiran');
    $routes->post('savelampir', 'extra\Lampiran::savelampiran');
    $routes->post('dellampir', 'extra\Lampiran::deletelampiran');
});
$routes->group('divisi', ['filter' => 'auth'],  function ($routes) {
    $routes->get('/', 'file\deklarasi\Divisi::index');
    $routes->get('input', 'file\deklarasi\Divisi::crany');
    $routes->get('input/(:any)', 'file\deklarasi\Divisi::showdata/$1');
    $routes->post('save', 'file\deklarasi\Divisi::savedata');
});
$routes->group('wilayah', ['filter' => 'auth'],  function ($routes) {
    $routes->get('/', 'file\deklarasi\Wilayah::index');
    $routes->get('input', 'file\deklarasi\Wilayah::crany');
    $routes->get('input/(:any)', 'file\deklarasi\Wilayah::showdata/$1');
    $routes->post('save', 'file\deklarasi\Wilayah::savedata');
});
$routes->group('auser', ['filter' => 'auth'],  function ($routes) {
    $routes->get('/', 'file\deklarasi\aUser::index');
    $routes->get('input/(:any)', 'file\deklarasi\aUser::showdata/$1');
    $routes->post('save', 'file\deklarasi\aUser::savedata');
});
$routes->group('satuan', ['filter' => 'auth'],  function ($routes) {
    $routes->get('/', 'file\deklarasi\Satuan::index');
    $routes->get('input', 'file\deklarasi\Satuan::crany');
    $routes->get('input/(:any)', 'file\deklarasi\Satuan::showdata/$1');
    $routes->post('save', 'file\deklarasi\Satuan::savedata');
});
$routes->group('gudang', ['filter' => 'auth'],  function ($routes) {
    $routes->get('/', 'file\deklarasi\Gudang::index');
    $routes->get('input', 'file\deklarasi\Gudang::crany');
    $routes->get('input/(:any)', 'file\deklarasi\Gudang::showdata/$1');
    $routes->post('save', 'file\deklarasi\Gudang::savedata');
});
$routes->group('nodokumen', ['filter' => 'auth'],  function ($routes) {
    $routes->get('/', 'file\deklarasi\NomorDokumen::index');
    $routes->get('input', 'file\deklarasi\NomorDokumen::crany');
    $routes->get('input/(:any)', 'file\deklarasi\NomorDokumen::showdata/$1');
    $routes->post('save', 'file\deklarasi\NomorDokumen::savedata');
});
$routes->group('noform', ['filter' => 'auth'],  function ($routes) {
    $routes->get('/', 'file\deklarasi\NomorForm::index');
    $routes->get('input', 'file\deklarasi\NomorForm::crany');
    $routes->get('input/(:any)', 'file\deklarasi\NomorForm::showdata/$1');
    $routes->post('save', 'file\deklarasi\NomorForm::savedata');
    $routes->get('tabdata', 'file\deklarasi\NomorForm::tabeldata');
});
$routes->group('propinsi', ['filter' => 'auth'],  function ($routes) {
    $routes->get('/', 'file\deklarasi\Propinsi::index');
    $routes->get('input', 'file\deklarasi\Propinsi::crany');
    $routes->get('input/(:any)', 'file\deklarasi\Propinsi::showdata/$1');
    $routes->post('save', 'file\deklarasi\Propinsi::savedata');
});
$routes->group('katproyek', ['filter' => 'auth'],  function ($routes) {
    $routes->get('/', 'file\deklarasi\Katproyek::index');
    $routes->get('input', 'file\deklarasi\Katproyek::crany');
    $routes->get('input/(:any)', 'file\deklarasi\Katproyek::showdata/$1');
    $routes->post('save', 'file\deklarasi\Katproyek::savedata');
});
$routes->group('biayal', ['filter' => 'auth'],  function ($routes) {
    $routes->get('/', 'file\deklarasi\Biayalangsung::index');
    $routes->get('input', 'file\deklarasi\Biayalangsung::crany');
    $routes->get('input/(:any)', 'file\deklarasi\Biayalangsung::showdata/$1');
    $routes->post('save', 'file\deklarasi\Biayalangsung::savedata');
    $routes->get('tabdata', 'file\deklarasi\Biayalangsung::tabeldata');
});
$routes->group('biayatl', ['filter' => 'auth'],  function ($routes) {
    $routes->get('/', 'file\deklarasi\Biayatidaklangsung::index');
    $routes->get('input', 'file\deklarasi\Biayatidaklangsung::crany');
    $routes->get('input/(:any)', 'file\deklarasi\Biayatidaklangsung::showdata/$1');
    $routes->post('save', 'file\deklarasi\Biayatidaklangsung::savedata');
    $routes->post('akun', 'extra\Loadfile::loadakun');
    $routes->get('tabdata', 'file\deklarasi\Biayatidaklangsung::tabeldata');
});
$routes->group('biayasd', ['filter' => 'auth'],  function ($routes) {
    $routes->get('/', 'file\deklarasi\Biayasd::index');
    $routes->get('input', 'file\deklarasi\Biayasd::crany');
    $routes->get('input/(:any)', 'file\deklarasi\Biayasd::showdata/$1');
    $routes->post('save', 'file\deklarasi\Biayasd::savedata');
    $routes->post('akun', 'extra\Loadfile::loadakun');
    $routes->get('tabdata', 'file\deklarasi\Biayasd::tabeldata');
});
$routes->group('subruas', ['filter' => 'auth'],  function ($routes) {
    $routes->get('/', 'file\deklarasi\Subruas::index');
    $routes->get('input', 'file\deklarasi\Subruas::crany');
    $routes->get('input/(:any)', 'file\deklarasi\Subruas::showdata/$1');
    $routes->post('save', 'file\deklarasi\Subruas::savedata');
    $routes->get('tabdata', 'file\deklarasi\Subruas::tabeldata');
    $routes->post('loadproyek', 'extra\Loadfile::loadproyek');
    $routes->post('ruas', 'extra\Loadfile::loadruas');
});
$routes->group('lokasi', ['filter' => 'auth'],  function ($routes) {
    $routes->get('/', 'file\deklarasi\Lokasi::index');
    $routes->get('input', 'file\deklarasi\Lokasi::crany');
    $routes->get('input/(:any)', 'file\deklarasi\Lokasi::showdata/$1');
    $routes->post('save', 'file\deklarasi\Lokasi::savedata');
    $routes->get('tabdata', 'file\deklarasi\Lokasi::tabeldata');
});
$routes->group('anggaran', ['filter' => 'auth'],  function ($routes) {
    $routes->get('/', 'file\deklarasi\Anggaran::index');
    $routes->get('input', 'file\deklarasi\Anggaran::crany');
    $routes->get('input/(:any)', 'file\deklarasi\Anggaran::showdata/$1');
    $routes->post('additem', 'file\deklarasi\Anggaran::tambahdata');
    $routes->post('edititem', 'file\deklarasi\Anggaran::updatedata');
    $routes->post('delitem', 'file\deklarasi\Anggaran::deletedata');
    $routes->post('save', 'file\deklarasi\Anggaran::savedata');
    $routes->get('modalkoreksi', 'file\deklarasi\Anggaran::modaldata');
    $routes->post('akun', 'extra\Loadfile::loadakun');
    $routes->post('biaya', 'extra\Loadfile::loadbiaya');
    $routes->get('tabbudget', 'file\deklarasi\Anggaran::tabelbudget');
});
// ____________________________________________________________________________________________________________________________
$routes->group('camp', ['filter' => 'auth'],  function ($routes) {
    $routes->get('/', 'file\aset\Camp::index');
    $routes->get('input', 'file\aset\Camp::crany');
    $routes->get('input/(:any)', 'file\aset\Camp::showdata/$1');
    $routes->post('save', 'file\aset\Camp::savedata');
    $routes->get('tabdata', 'file\aset\Camp::tabeldata');
    $routes->get('tablampir', 'extra\Lampiran::tabellampiran');
    $routes->get('modallampir', 'extra\Lampiran::modallampiran');
    $routes->post('savelampir', 'extra\Lampiran::savelampiran');
    $routes->post('dellampir', 'extra\Lampiran::deletelampiran');
});
$routes->group('proyek', ['filter' => 'auth'],  function ($routes) {
    $routes->get('/', 'file\aset\Proyek::index');
    $routes->get('input', 'file\aset\Proyek::crany');
    $routes->get('input/(:any)', 'file\aset\Proyek::showdata/$1');
    $routes->post('save', 'file\aset\Proyek::savedata');
    $routes->get('tabdata', 'file\aset\Proyek::tabeldata');
    $routes->get('tablampir', 'extra\Lampiran::tabellampiran');
    $routes->get('modallampir', 'extra\Lampiran::modallampiran');
    $routes->post('savelampir', 'extra\Lampiran::savelampiran');
    $routes->post('dellampir', 'extra\Lampiran::deletelampiran');
    $routes->post('kabupaten', 'file\aset\Proyek::loadkabupaten');
    $routes->post('kbli', 'extra\Loadfile::loadkbli');
});
$routes->group('ruas', ['filter' => 'auth'],  function ($routes) {
    $routes->get('/', 'file\aset\Ruas::index');
    $routes->get('input', 'file\aset\Ruas::crany');
    $routes->get('input/(:any)', 'file\aset\Ruas::showdata/$1');
    $routes->post('save', 'file\aset\Ruas::savedata');
    $routes->get('mproyek', 'extra\Loadfile::modalproyek');
    $routes->post('proyek', 'extra\Loadfile::loadproyek');
    $routes->get('tabdata', 'file\aset\Ruas::tabeldata');
});
$routes->group('katalat', ['filter' => 'auth'],  function ($routes) {
    $routes->get('/', 'file\aset\Katalat::index');
    $routes->get('input', 'file\aset\Katalat::crany');
    $routes->get('input/(:any)', 'file\aset\Katalat::showdata/$1');
    $routes->post('save', 'file\aset\Katalat::savedata');
});
$routes->group('alat', ['filter' => 'auth'],  function ($routes) {
    $routes->get('/', 'file\aset\Alat::index');
    $routes->get('input', 'file\aset\Alat::crany');
    $routes->get('input/(:any)', 'file\aset\Alat::showdata/$1');
    $routes->post('save', 'file\aset\Alat::savedata');
    $routes->get('tabdata', 'file\aset\Alat::tabeldata');
    $routes->get('tablampir', 'extra\Lampiran::tabellampiran');
    $routes->get('modallampir', 'extra\Lampiran::modallampiran');
    $routes->post('savelampir', 'extra\Lampiran::savelampiran');
    $routes->post('dellampir', 'extra\Lampiran::deletelampiran');
    $routes->post('pegawai', 'extra\Loadfile::loadpenerima');
    $routes->post('kbli', 'extra\Loadfile::loadkbli');
    $routes->post('biaya', 'extra\Loadfile::loadbiaya');
});
$routes->group('tanah', ['filter' => 'auth'],  function ($routes) {
    $routes->get('/', 'file\aset\Tanah::index');
    $routes->get('input', 'file\aset\Tanah::crany');
    $routes->get('input/(:any)', 'file\aset\Tanah::showdata/$1');
    $routes->post('save', 'file\aset\Tanah::savedata');
    $routes->get('tabdata', 'file\aset\Tanah::tabeldata');
    $routes->get('tablampir', 'extra\Lampiran::tabellampiran');
    $routes->get('modallampir', 'extra\Lampiran::modallampiran');
    $routes->post('savelampir', 'extra\Lampiran::savelampiran');
    $routes->post('dellampir', 'extra\Lampiran::deletelampiran');
    $routes->post('kbli', 'extra\Loadfile::loadkbli');
});
$routes->group('tool', ['filter' => 'auth'],  function ($routes) {
    $routes->get('/', 'file\aset\Tool::index');
    $routes->get('input', 'file\aset\Tool::crany');
    $routes->get('input/(:any)', 'file\aset\Tool::showdata/$1');
    $routes->post('save', 'file\aset\Tool::savedata');
    $routes->get('tabdata', 'file\aset\Tool::tabeldata');
    $routes->get('tablampir', 'extra\Lampiran::tabellampiran');
    $routes->get('modallampir', 'extra\Lampiran::modallampiran');
    $routes->post('savelampir', 'extra\Lampiran::savelampiran');
    $routes->post('dellampir', 'extra\Lampiran::deletelampiran');
    $routes->post('kbli', 'extra\Loadfile::loadkbli');
    $routes->post('biaya', 'extra\Loadfile::loadbiaya');
});
$routes->group('inventaris', ['filter' => 'auth'],  function ($routes) {
    $routes->get('/', 'file\aset\Inventaris::index');
    $routes->get('input', 'file\aset\Inventaris::crany');
    $routes->get('input/(:any)', 'file\aset\Inventaris::showdata/$1');
    $routes->post('save', 'file\aset\Inventaris::savedata');
    $routes->get('tabdata', 'file\aset\Inventaris::tabeldata');
    $routes->get('basecamp', 'extra\Loadfile::modalcamp');
    $routes->post('pegawai', 'extra\Loadfile::loadpenerima');
});
// ____________________________________________________________________________________________________________________________
$routes->group('akuntansi', ['filter' => 'auth'],  function ($routes) {
    $routes->get('/', 'file\akuntansi\Akuntansi::index');
    $routes->get('input', 'file\akuntansi\Akuntansi::crany');
    $routes->get('input/(:any)', 'file\akuntansi\Akuntansi::showdata/$1');
    $routes->post('save', 'file\akuntansi\Akuntansi::savedata');
    $routes->get('tabdata', 'file\akuntansi\Akuntansi::tabeldata');
});
$routes->group('akungrup', ['filter' => 'auth'],  function ($routes) {
    $routes->get('/', 'file\akuntansi\Akungrup::index');
    $routes->get('input', 'file\akuntansi\Akungrup::crany');
    $routes->get('input/(:any)', 'file\akuntansi\Akungrup::showdata/$1');
    $routes->post('save', 'file\akuntansi\Akungrup::savedata');
    $routes->post('akun', 'extra\Loadfile::loadakun');
});
$routes->group('akunkas', ['filter' => 'auth'],  function ($routes) {
    $routes->get('/', 'file\akuntansi\Akunkas::index');
    $routes->get('input', 'file\akuntansi\Akunkas::crany');
    $routes->get('input/(:any)', 'file\akuntansi\Akunkas::showdata/$1');
    $routes->post('save', 'file\akuntansi\Akunkas::savedata');
    $routes->post('akun', 'extra\Loadfile::loadakun');
});
$routes->group('akunpajak', ['filter' => 'auth'],  function ($routes) {
    $routes->get('/', 'file\akuntansi\Akunpajak::index');
    $routes->get('input', 'file\akuntansi\Akunpajak::crany');
    $routes->get('input/(:any)', 'file\akuntansi\Akunpajak::showdata/$1');
    $routes->post('save', 'file\akuntansi\Akunpajak::savedata');
    $routes->post('akun', 'extra\Loadfile::loadakun');
});
$routes->group('dokumenpajak', ['filter' => 'auth'],  function ($routes) {
    $routes->get('/', 'file\akuntansi\Dokumenpajak::index');
    $routes->get('input', 'file\akuntansi\Dokumenpajak::crany');
    $routes->get('input/(:any)', 'file\akuntansi\Dokumenpajak::showdata/$1');
    $routes->post('save', 'file\akuntansi\Dokumenpajak::savedata');
    $routes->get('tabdata', 'file\akuntansi\Dokumenpajak::tabeldata');
});
// ____________________________________________________________________________________________________________________________
$routes->group('barang', ['filter' => 'auth'],  function ($routes) {
    $routes->get('/', 'file\item\Barang::index');
    $routes->get('input', 'file\item\Barang::crany');
    $routes->get('input/(:any)', 'file\item\Barang::showdata/$1');
    $routes->post('save', 'file\item\Barang::savedata');
    $routes->get('tabdata', 'extra\Loadfile::tabelbarang');
});
$routes->group('noseri', ['filter' => 'auth'],  function ($routes) {
    $routes->get('/', 'file\item\Noseri::index');
    $routes->get('input', 'file\item\Noseri::crany');
    $routes->get('input/(:any)', 'file\item\Noseri::showdata/$1');
    $routes->post('save', 'file\item\Noseri::savedata');
    $routes->post('alat', 'extra\Loadfile::loadalat');
    $routes->get('tabdata', 'file\item\Noseri::tabelbarang');
});
$routes->group('bahan', ['filter' => 'auth'],  function ($routes) {
    $routes->get('/', 'file\item\Bahan::index');
    $routes->get('input', 'file\item\Bahan::crany');
    $routes->get('input/(:any)', 'file\item\Bahan::showdata/$1');
    $routes->post('save', 'file\item\Bahan::savedata');
    $routes->post('biaya', 'extra\Loadfile::loadbiaya');
    $routes->post('gantibiaya', 'file\item\Bahan::outfocusbiaya');
    $routes->get('tabdata', 'extra\Loadfile::tabelbarang');
});
$routes->group('bekas', ['filter' => 'auth'],  function ($routes) {
    $routes->get('/', 'file\item\Bekas::index');
    $routes->get('input', 'file\item\Bekas::crany');
    $routes->get('input/(:any)', 'file\item\Bekas::showdata/$1');
    $routes->post('save', 'file\item\Bekas::savedata');
    $routes->get('tabdata', 'extra\Loadfile::tabelbarang');
});
$routes->group('nonstok', ['filter' => 'auth'],  function ($routes) {
    $routes->get('/', 'file\item\Nonstok::index');
    $routes->get('input', 'file\item\Nonstok::crany');
    $routes->get('input/(:any)', 'file\item\Nonstok::showdata/$1');
    $routes->post('save', 'file\item\Nonstok::savedata');
    $routes->get('tabdata', 'extra\Loadfile::tabelbarang');
});
// ____________________________________________________________________________________________________________________________
$routes->group('penerima', ['filter' => 'auth'],  function ($routes) {
    $routes->get('/', 'file\penerima\Penerima::index');
    $routes->get('input', 'file\penerima\Penerima::crany');
    $routes->get('input/(:any)', 'file\penerima\Penerima::showdata/$1');
    $routes->post('save', 'file\penerima\Penerima::savedata');
    $routes->get('tabdata', 'file\penerima\Penerima::tabeldata');
});
$routes->group('tautp', ['filter' => 'auth'],  function ($routes) {
    $routes->get('/', 'file\penerima\Tautp::index');
    $routes->get('input/(:any)', 'file\penerima\Tautp::showdata/$1');
    $routes->post('save', 'file\penerima\Tautp::savedata');
});
$routes->group('rekanalat', ['filter' => 'auth'],  function ($routes) {
    $routes->get('/', 'file\penerima\RekanAlat::index');
    $routes->get('input', 'file\penerima\RekanAlat::crany');
    $routes->get('input/(:any)', 'file\penerima\RekanAlat::showdata/$1');
    $routes->post('save', 'file\penerima\RekanAlat::savedata');
    $routes->post('penerima', 'extra\Loadfile::loadpenerima');
    $routes->get('tabdata', 'file\penerima\RekanAlat::tabeldata');
});
// ____________________________________________________________________________________________________________________________
$routes->group('jabatan', ['filter' => 'auth'],  function ($routes) {
    $routes->get('/', 'file\sdm\Jabatan::index');
    $routes->get('input', 'file\sdm\Jabatan::crany');
    $routes->get('input/(:any)', 'file\sdm\Jabatan::showdata/$1');
    $routes->post('save', 'file\sdm\Jabatan::savedata');
});
$routes->group('golongan', ['filter' => 'auth'],  function ($routes) {
    $routes->get('/', 'file\sdm\Golongan::index');
    $routes->get('input', 'file\sdm\Golongan::crany');
    $routes->get('input/(:any)', 'file\sdm\Golongan::showdata/$1');
    $routes->post('save', 'file\sdm\Golongan::savedata');
});
$routes->group('katrating', ['filter' => 'auth'],  function ($routes) {
    $routes->get('/', 'file\sdm\Katrating::index');
    $routes->get('input', 'file\sdm\Katrating::crany');
    $routes->get('input/(:any)', 'file\sdm\Katrating::showdata/$1');
    $routes->post('save', 'file\sdm\Katrating::savedata');
});
$routes->group('cuti', ['filter' => 'auth'],  function ($routes) {
    $routes->get('/', 'file\sdm\Cuti::index');
    $routes->get('input', 'file\sdm\Cuti::crany');
    $routes->get('input/(:any)', 'file\sdm\Cuti::showdata/$1');
    $routes->post('save', 'file\sdm\Cuti::savedata');
});
$routes->group('kalender', ['filter' => 'auth'],  function ($routes) {
    $routes->get('/', 'file\sdm\Kalender::index');
    $routes->get('modalinput', 'file\sdm\Kalender::modaldata');
    $routes->post('save', 'file\sdm\Kalender::savedata');
    $routes->post('hapus', 'file\sdm\Kalender::deletedata');
    $routes->get('tabdata', 'file\sdm\Kalender::tabeldata');
});
$routes->group('pengumuman', ['filter' => 'auth'],  function ($routes) {
    $routes->get('/', 'file\sdm\Pengumuman::index');
    $routes->post('save', 'file\sdm\Pengumuman::savedata');
});
$routes->group('pegawai', ['filter' => 'auth'],  function ($routes) {
    $routes->get('/', 'file\sdm\Pegawai::index');
    $routes->get('input', 'file\sdm\Pegawai::crany');
    $routes->get('input/(:any)', 'file\sdm\Pegawai::showdata/$1');
    $routes->post('save', 'file\sdm\Pegawai::savedata');
    $routes->get('tabdata', 'file\sdm\Pegawai::tabeldata');
    $routes->get('tablampir', 'extra\Lampiran::tabellampiran');
    $routes->get('modallampir', 'extra\Lampiran::modallampiran');
    $routes->post('savelampir', 'extra\Lampiran::savelampiran');
    $routes->post('dellampir', 'extra\Lampiran::deletelampiran');
    $routes->get('basecamp', 'extra\Loadfile::modalcamp');
    $routes->post('pegawai', 'extra\Loadfile::loadpenerima');
    $routes->post('user', 'extra\Loadfile::loaduser');
});

// Transaksi Umum____________________________________________________________________________________________________________________________
$routes->group('anggbiayal', ['filter' => 'auth'],  function ($routes) {
    $routes->get('/', 'trumum\anggaran\Biayalangsung::index');
    $routes->get('input', 'trumum\anggaran\Biayalangsung::crany');
    $routes->get('input/(:any)', 'trumum\anggaran\Biayalangsung::showdata/$1');
    $routes->post('additem', 'trumum\anggaran\Biayalangsung::tambahdata');
    // $routes->post('edititem', 'trumum\anggaran\Cabang::updatedata');
    // $routes->post('delitem', 'trumum\anggaran\Cabang::deletedata');

    // $routes->post('addbudget', 'umum\anggaran\Cabang::tambahdata');
    // $routes->post('savedoc', 'umum\anggaran\Cabang::savedokumen');
    // // $routes->get('bataldoc/(:any)', 'umum\anggaran\Biayatidaklangsung::canceldokumen/$1');
    $routes->get('tabinduk', 'extra\Loadtran::tabelanggaraninduk');
    $routes->get('proyek', 'extra\Loadfile::modalproyek');
    $routes->post('ruas', 'extra\Loadfile::loadruas');
    $routes->post('biaya', 'extra\Loadfile::loadbiaya');

    $routes->get('tabbiaya', 'extra\Loadtran::tabeldataanggaran');
    $routes->post('savedoc', 'trumum\anggaran\Biayalangsung::savedata');
    $routes->get('modalbatal', 'trumum\anggaran\Biayalangsung::modalbatal');

    $routes->post('bataldoc', 'trumum\anggaran\Biayalangsung::canceldata');

    // $routes->post('loadbudget', 'umum\anggaran\Cabang::loadbudgetbawaan');
    // // $routes->get('editkas', 'proyek\anggaran\Biayatidaklangsung::modalkoreksikas');
    // // $routes->post('delbudget', 'umum\anggaran\Camp::deletedata');
});
$routes->group('anggobjek', ['filter' => 'auth'],  function ($routes) {
    $routes->get('/', 'trumum\anggaran\Objek::index');
    $routes->get('input', 'trumum\anggaran\Objek::crany');
    $routes->get('input/(:any)', 'trumum\anggaran\Objek::showdata/$1');
    $routes->post('additem', 'trumum\anggaran\Objek::tambahdata');
    $routes->post('edititem', 'trumum\anggaran\Objek::updatedata');
    $routes->post('delitem', 'trumum\anggaran\Objek::deletedata');

    // $routes->post('addbudget', 'umum\anggaran\Cabang::tambahdata');
    // $routes->post('savedoc', 'umum\anggaran\Cabang::savedokumen');
    // // $routes->get('bataldoc/(:any)', 'umum\anggaran\Biayatidaklangsung::canceldokumen/$1');
    $routes->get('tabinduk', 'extra\Loadtran::tabelanggaraninduk');
    $routes->get('beban', 'extra\Loadfile::modalbeban');
    $routes->post('akun', 'extra\Loadfile::loadakun');
    $routes->post('biaya', 'extra\Loadfile::loadbiaya');

    $routes->get('tabbiaya', 'extra\Loadtran::tabeldataanggaran');
    // $routes->post('loadbudget', 'umum\anggaran\Cabang::loadbudgetbawaan');
    // // $routes->get('editkas', 'proyek\anggaran\Biayatidaklangsung::modalkoreksikas');
    // // $routes->post('delbudget', 'umum\anggaran\Camp::deletedata');
});



// $routes->group('sojual', ['filter' => 'auth'],  function ($routes) {
//     $routes->get('/', 'umum\penjualan\SOJual::index');
//     $routes->get('input', 'umum\penjualan\SOJual::crany');
//     $routes->get('input/(:any)', 'umum\penjualan\SOJual::showdata/$1');
//     $routes->post('addjual', 'umum\penjualan\SOJual::tambahdata');
//     // $routes->post('savedoc', 'kas\Kaslangsung::savedokumen');
//     // $routes->get('bataldoc/(:any)', 'kas\Kaslangsung::canceldokumen/$1');
//     $routes->get('tabsales', 'extra\Loadtran::tabelsalesinduk');
//     $routes->get('camp', 'extra\Loadfile::modalcamp');
//     $routes->get('proyek', 'extra\Loadfile::modalproyek');
//     $routes->post('penerima1', 'extra\Loadfile::loadpenerima1');
//     $routes->post('pelanggan', 'extra\Loadfile::loadpenerima');
//     $routes->post('barang', 'extra\Loadfile::loadbarang');
//     $routes->post('alat', 'extra\Loadfile::loadalat');
//     $routes->post('tanah', 'extra\Loadfile::loadtanah');
//     $routes->post('inventaris', 'extra\Loadfile::loadinventaris');
//     $routes->post('satuan', 'umum\penjualan\SOJual::loadsatuan');
//     $routes->post('bentuk', 'umum\penjualan\SOJual::loadbentuk');
//     $routes->post('loadcamp', 'umum\penjualan\SOJual::loadcamp');
//     $routes->get('tabsalesitem', 'extra\Loadtran::tabelsalesanak');

//     // $routes->post('biaya', 'Komponen::loadbiaya');
//     // $routes->get('editkas', 'camp\Biayalangsung::modalkoreksikas');
//     // $routes->post('delitem', 'camp\Biayalangsung::deletedata');
// });

// $routes->group('sosewa', ['filter' => 'auth'],  function ($routes) {
//     $routes->get('/', 'umum\penjualan\SOSewa::index');
//     $routes->get('input', 'umum\penjualan\SOSewa::crany');
//     $routes->get('input/(:any)', 'umum\penjualan\SOSewa::showdata/$1');
//     $routes->post('addjual', 'umum\penjualan\SOSewa::tambahdata');
//     // $routes->post('savedoc', 'kas\Kaslangsung::savedokumen');
//     // $routes->get('bataldoc/(:any)', 'kas\Kaslangsung::canceldokumen/$1');
//     $routes->get('tabsales', 'extra\Loadtran::tabelsalesinduk');
//     $routes->get('camp', 'extra\Loadfile::modalcamp');
//     $routes->get('proyek', 'extra\Loadfile::modalproyek');
//     $routes->post('penerima1', 'extra\Loadfile::loadpenerima1');
//     $routes->post('pelanggan', 'extra\Loadfile::loadpenerima');
//     $routes->post('barang', 'extra\Loadfile::loadbarang');
//     $routes->post('alat', 'extra\Loadfile::loadalat');
//     $routes->post('tanah', 'extra\Loadfile::loadtanah');
//     $routes->post('inventaris', 'extra\Loadfile::loadinventaris');
//     $routes->post('satuan', 'umum\penjualan\SOSewa::loadsatuan');
//     $routes->post('bentuk', 'umum\penjualan\SOSewa::loadbentuk');
//     $routes->post('loadcamp', 'umum\penjualan\SOSewa::loadcamp');
//     $routes->get('tabsalesitem', 'extra\Loadtran::tabelsalesanak');

//     // $routes->post('biaya', 'Komponen::loadbiaya');
//     // $routes->get('editkas', 'camp\Biayalangsung::modalkoreksikas');
//     // $routes->post('delitem', 'camp\Biayalangsung::deletedata');
// });

// Transaksi Item____________________________________________________________________________________________________________________________
$routes->group('mintabarang', ['filter' => 'auth'],  function ($routes) {
    $routes->get('/', 'tritem\pembelian\Mintabarang::index');
    $routes->get('input', 'tritem\pembelian\Mintabarang::crany');
    $routes->get('input/(:any)', 'tritem\pembelian\Mintabarang::showdata/$1');
    $routes->post('peminta', 'extra\Loadfile::loaduser');
    $routes->post('additem', 'tritem\pembelian\Mintabarang::tambahdata');
    $routes->post('edititem', 'tritem\pembelian\Mintabarang::updatedata');
    $routes->post('delitem', 'tritem\pembelian\Mintabarang::deletedata');
    $routes->post('item', 'extra\Loadfile::loadbarang');
    $routes->post('jasa', 'extra\Loadfile::loadakun');
    $routes->post('satuan', 'tritem\pembelian\Mintabarang::loadsatuan');
    $routes->get('modalkoreksi', 'tritem\pembelian\Mintabarang::modaldata');
    $routes->get('mbarang', 'extra\Loadfile::modalbarang');
    $routes->get('tabminta', 'extra\Loadtran::tabelmintabarang');
    $routes->get('tabbarang', 'extra\Loadtran::tabeldatabarang');
    $routes->get('logaksi', 'extra\Loadtran::tabellogaksi');
    $routes->post('savedoc', 'tritem\pembelian\Mintabarang::savedata');
    $routes->post('bataldoc', 'tritem\pembelian\Mintabarang::canceldata');
    $routes->post('confdoc', 'tritem\pembelian\Mintabarang::confirmdata');
});
$routes->group('cekada', ['filter' => 'auth'],  function ($routes) {
    $routes->get('/', 'tritem\pembelian\Cekada::index');
    $routes->get('input/(:any)', 'tritem\pembelian\Cekada::showdata/$1');
    $routes->get('tabminta', 'extra\Loadtran::tabelmintabarang');
    $routes->get('tabbarang', 'extra\Loadtran::tabeldatabarang');
    $routes->post('additem', 'tritem\pembelian\Cekada::tambahdata');
    $routes->post('savedoc', 'tritem\pembelian\Cekada::savedata');
    $routes->get('mbarang', 'extra\Loadfile::modalbarang');
});
$routes->group('cekbarang', ['filter' => 'auth'],  function ($routes) {
    $routes->get('/', 'tritem\pembelian\Cekbarang::index');
    $routes->get('input/(:any)', 'tritem\pembelian\Cekbarang::showdata/$1');
    $routes->get('tabminta', 'extra\Loadtran::tabelmintabarang');
    $routes->get('tabbarang', 'extra\Loadtran::tabeldatabarang');
    $routes->get('logaksi', 'extra\Loadtran::tabellogaksi');
    $routes->post('savedoc', 'tritem\pembelian\Cekbarang::savedata');
});
$routes->group('tawarharga', ['filter' => 'auth'],  function ($routes) {
    $routes->get('/', 'tritem\pembelian\Tawarharga::index');
    $routes->get('input/(:any)', 'tritem\pembelian\Tawarharga::showdata/$1');
    $routes->post('additem', 'tritem\pembelian\Tawarharga::tambahdata');
    $routes->post('edititem', 'tritem\pembelian\Tawarharga::updatedata');
    $routes->post('delitem', 'tritem\pembelian\Tawarharga::deletedata');
    $routes->post('suplier', 'extra\Loadfile::loadpenerima');
    $routes->get('mbarang', 'extra\Loadfile::modalbarang');
    $routes->get('msuplier', 'extra\Loadfile::modalpenerima');
    $routes->get('modalkoreksi', 'tritem\pembelian\Tawarharga::modaldata');
    $routes->get('tabminta', 'extra\Loadtran::tabelmintabarang');
    $routes->get('tabbarang', 'extra\Loadtran::tabeldatabarang');
    $routes->get('tabharga', 'extra\Loadtran::tabelhargatawar');
    // $routes->post('savedoc', 'tritem\pembelian\Tawarharga::savedata');
});
$routes->group('pilihharga', ['filter' => 'auth'],  function ($routes) {
    $routes->get('/', 'tritem\pembelian\Pilihharga::index');
    $routes->get('input/(:any)', 'tritem\pembelian\Pilihharga::showdata/$1');
    $routes->get('tabminta', 'extra\Loadtran::tabelmintabarang');
    $routes->get('tabharga', 'extra\Loadtran::tabeltawar');
    $routes->get('logaksi', 'extra\Loadtran::tabellogaksi');
    $routes->post('suplier', 'tritem\pembelian\Pilihharga::pilihpenawaran');
    // $routes->post('savedoc', 'tritem\pembelian\Pilihharga::savedata');
});

// $routes->group('bandingharga', ['filter' => 'auth'],  function ($routes) {
//     $routes->get('/', 'tritem\pembelian\Bandingharga::index');
//     $routes->get('input/(:any)', 'tritem\pembelian\Bandingharga::showdata/$1');
//     $routes->get('tabminta', 'extra\Loadtran::tabelmintabarang');
// $routes->get('showitem', 'Komponen::modalitem');
// $routes->post('save', 'pembelian\Bandingharga::savedata');
// $routes->post('penerima', 'Komponen::loadpenerima');
// $routes->get('tabbarang', 'Komponen::tabelbarang');
// $routes->get('tabtawar', 'pembelian\Bandingharga::modalpenawaran');
// $routes->post('deltawar', 'pembelian\Bandingharga::deletepenawaran');
// $routes->post('pilihtawar', 'pembelian\Bandingharga::pilihpenawaran');
// });
// $routes->group('pesanbarang', ['filter' => 'auth'],  function ($routes) {
//     $routes->get('/', 'pembelian\Pesanbarang::index');
//     $routes->get('input', 'pembelian\Pesanbarang::crany');
//     $routes->get('input/(:any)', 'pembelian\Pesanbarang::showdata/$1');
//     $routes->get('tabpesan', 'Komponen::tabelpesanbarang');
//     $routes->post('penerima', 'Komponen::loadpenerima');
//     $routes->post('biaya', 'Komponen::loadakun');
//     $routes->get('dokumen', 'pembelian\Pesanbarang::modaldokumen');
//     $routes->get('tabbarang', 'pembelian\Pesanbarang::tabelbarang');
//     $routes->get('tabbiaya', 'pembelian\Pesanbarang::tabelbiaya');
//     $routes->post('addbiaya', 'pembelian\Pesanbarang::savebiaya');
//     $routes->post('save/(:any)', 'pembelian\Pesanbarang::savedata/$1');
// });
// $routes->group('terimabarang', ['filter' => 'auth'],  function ($routes) {
//     $routes->get('/', 'pembelian\Terimabarang::index');
//     $routes->get('input/(:any)', 'pembelian\Terimabarang::showdata/$1');
//     $routes->get('tabpesan', 'Komponen::tabelpesanbarang');
//     $routes->get('tabbarang', 'pembelian\Terimabarang::tabelbarang');
//     $routes->get('tabmasuk', 'pembelian\Terimabarang::tabelpomasuk');
//     $routes->post('save', 'pembelian\Terimabarang::savedata');
// });
// $routes->group('cekpo', ['filter' => 'auth'],  function ($routes) {
//     $routes->get('/', 'pembelian\Cekpo::index');
//     $routes->get('tabpesan', 'Komponen::tabelpesanbarang');
//     $routes->get('input/(:any)', 'pembelian\Cekpo::showdata/$1');
//     $routes->get('tabbarang', 'pembelian\Cekpo::tabelbarang');
//     $routes->post('save', 'pembelian\Cekpo::savedata');
//     $routes->get('logaksi', 'Komponen::tabellogaksi');
// });

$routes->group('ambilbarang', ['filter' => 'auth'],  function ($routes) {
    $routes->get('/', 'tritem\pengambilan\Ambilbarang::index');
    $routes->get('input', 'tritem\pengambilan\Ambilbarang::showdata');
    $routes->post('additem', 'tritem\pengambilan\Ambilbarang::tambahdata');
    $routes->post('edititem', 'tritem\pengambilan\Ambilbarang::updatedata');
    $routes->post('delitem', 'tritem\pengambilan\Ambilbarang::deletedata');

    $routes->post('pegawai', 'extra\Loadfile::loadpenerima');
    $routes->post('perusahaan', 'tritem\pengambilan\Ambilbarang::loadperusahaan');
    $routes->post('atk', 'tritem\pengambilan\Ambilbarang::loadatk');
    $routes->post('atkm', 'tritem\pengambilan\Ambilbarang::loadatk');
    // $routes->post('satuan', 'tritem\pembelian\Mintabarang::loadsatuan');
    // $routes->get('modalkoreksi', 'tritem\pembelian\Mintabarang::modaldata');
    // $routes->get('mbarang', 'extra\Loadfile::modalbarang');
    $routes->get('tabambil', 'extra\Loadtran::tabelambilbarang');
    $routes->get('tabbarang', 'extra\Loadtran::tabeldatabarangambil');
    $routes->get('modalinput', 'tritem\pengambilan\Ambilbarang::modalinput');
    $routes->get('modalkoreksi', 'tritem\pengambilan\Ambilbarang::modaldata');

    // $routes->get('logaksi', 'extra\Loadtran::tabellogaksi');
    $routes->post('saveatk', 'tritem\pengambilan\Ambilbarang::saveatk');
    // $routes->post('bataldoc', 'tritem\pembelian\Mintabarang::canceldata');
    // $routes->post('confdoc', 'tritem\pembelian\Mintabarang::confirmdata');

});

// Proyek____________________________________________________________________________________________________________________________
// $routes->group('anggproyekbl', ['filter' => 'auth'],  function ($routes) {
//     $routes->get('/', 'proyek\anggaran\BiayaL::index');
//     $routes->get('input', 'proyek\anggaran\BiayaL::crany');
//     $routes->get('input/(:any)', 'proyek\anggaran\BiayaL::showdata/$1');
//     $routes->post('addbudget', 'proyek\anggaran\BiayaL::tambahdata');
//     $routes->post('savedoc', 'proyek\anggaran\BiayaL::savedokumen');
//     // $routes->get('bataldoc/(:any)', 'proyek\anggaran\Biayatidaklangsung::canceldokumen/$1');
//     $routes->get('tabanginduk', 'extra\Loadtran::tabelanggaraninduk');
//     $routes->get('proyek', 'extra\Loadfile::modalproyek');
//     $routes->post('ruas', 'extra\Loadfile::loadruas');
//     $routes->post('biaya', 'extra\Loadfile::loadbiaya');
//     $routes->get('tabbudget', 'extra\Loadtran::tabelanggarananak');
//     $routes->post('loadbudget', 'proyek\anggaran\BiayaL::loadbudgetbawaan');
//     // $routes->get('editkas', 'proyek\anggaran\Biayatidaklangsung::modalkoreksikas');
//     $routes->post('delbudget', 'proyek\anggaran\BiayaL::deletedata');
// });
// $routes->group('anggproyekbtl', ['filter' => 'auth'],  function ($routes) {
//     $routes->get('/', 'proyek\anggaran\BiayaTL::index');
//     $routes->get('input', 'proyek\anggaran\BiayaTL::crany');
//     $routes->get('input/(:any)', 'proyek\anggaran\BiayaTL::showdata/$1');
//     $routes->post('addbudget', 'proyek\anggaran\BiayaTL::tambahdata');
//     $routes->post('savedoc', 'proyek\anggaran\BiayaTL::savedokumen');
//     // $routes->get('bataldoc/(:any)', 'proyek\anggaran\Biayatidaklangsung::canceldokumen/$1');
//     $routes->get('tabanginduk', 'extra\Loadtran::tabelanggaraninduk');
//     $routes->get('proyek', 'extra\Loadfile::modalproyek');
//     $routes->post('biaya', 'extra\Loadfile::loadbiaya');
//     $routes->get('tabbudget', 'extra\Loadtran::tabelanggarananak');
//     $routes->post('loadbudget', 'proyek\anggaran\BiayaTL::loadbudgetbawaan');
//     // $routes->get('editkas', 'proyek\anggaran\Biayatidaklangsung::modalkoreksikas');
//     $routes->post('delbudget', 'proyek\anggaran\BiayaTL::deletedata');
// });
// $routes->group('accbudget', ['filter' => 'auth'],  function ($routes) {
//     $routes->get('/', 'proyek\anggaran\Accbudget::index');
//     $routes->get('input/(:any)', 'proyek\anggaran\Accbudget::showdata/$1');
//     $routes->post('addbudget', 'proyek\anggaran\Accbudget::tambahdata');
//     $routes->post('savedoc', 'proyek\anggaran\Accbudget::savedokumen');
//     $routes->get('bataldoc/(:any)', 'proyek\anggaran\Accbudget::canceldokumen/$1');
//     $routes->get('tabbudget', 'extra\Loadtran::tabelbudgetinduk');
//     $routes->get('proyek', 'extra\Loadfile::modalproyek');
//     $routes->post('ruas', 'extra\Loadfile::loadruas');
//     $routes->post('biaya', 'extra\Loadfile::loadbiaya');
//     $routes->get('tabbudgetitem', 'extra\Loadtran::tabelbudgetanak');

//     // $routes->get('editkas', 'proyek\anggaran\Biayalangsung::modalkoreksikas');
//     $routes->post('delitem', 'proyek\anggaran\Biayalangsung::deletedata');
// });

// ALAT____________________________________________________________________________________________________________________________
$routes->group('sewaalat', ['filter' => 'auth'],  function ($routes) {
    $routes->get('/', 'alat\order\Sewaalat::index');
    $routes->get('input', 'alat\order\Sewaalat::crany');
    $routes->get('input/(:any)', 'alat\order\Sewaalat::showdata/$1');
    $routes->post('addjual', 'alat\order\Sewaalat::tambahdata');
    // $routes->post('savedoc', 'kas\Kaslangsung::savedokumen');
    // $routes->get('bataldoc/(:any)', 'kas\Kaslangsung::canceldokumen/$1');
    $routes->get('tabsales', 'extra\Loadtran::tabelsalesinduk');
    $routes->get('proyek', 'extra\Loadfile::modalproyek');
    $routes->post('penerima1', 'extra\Loadfile::loadpenerima1');
    $routes->post('pelanggan', 'extra\Loadfile::loadpenerima');
    $routes->post('alat', 'extra\Loadfile::loadalat');
    $routes->post('bentuk', 'alat\order\Sewaalat::loadbentuk');
    $routes->post('loadcamp', 'alat\order\Sewaalat::loadcamp');
    $routes->get('tabsalesitem', 'extra\Loadtran::tabelsalesanak');

    // $routes->post('biaya', 'Komponen::loadbiaya');
    // $routes->get('editkas', 'camp\Biayalangsung::modalkoreksikas');
    // $routes->post('delitem', 'camp\Biayalangsung::deletedata');
});
$routes->group('tiketproyek', ['filter' => 'auth'],  function ($routes) {
    $routes->get('/', 'alat\tiket\Tiketproyek::index');
    $routes->post('addtiket', 'alat\tiket\Tiketproyek::tambahdata');
    $routes->get('camp', 'extra\Loadfile::modalcamp');
    $routes->post('docjual', 'alat\tiket\Tiketproyek::loadsojual');
    $routes->post('gantidocjual', 'alat\tiket\Tiketproyek::outfocusdocjual');
    $routes->post('gantiruas', 'alat\tiket\Tiketproyek::outfocusruas');
    $routes->post('gantidocsewa', 'alat\tiket\Tiketproyek::outfocusdocsewa');
    $routes->post('gantijasa', 'alat\tiket\Tiketproyek::outfocusjasa');
    $routes->post('gantibarang', 'alat\tiket\Tiketproyek::outfocusbarang');
    $routes->post('alat', 'alat\tiket\Tiketproyek::loadalat');
    $routes->post('gantialat', 'alat\tiket\Tiketproyek::outfocusalat');
    $routes->post('supir', 'extra\Loadfile::loadpenerima');
    $routes->post('gantisupir', 'alat\tiket\Tiketproyek::outfocussupir');
    $routes->get('tabtiket', 'extra\Loadtran::tabeltiket');

    // $routes->get('beban', 'Komponen::modalbeban');
    // $routes->post('biaya', 'Komponen::loadbiaya');
    // $routes->get('tabitembiaya', 'Komponen::tabelbudgetanak');
    // $routes->get('editkas', 'camp\Biayalangsung::modalkoreksikas');
    // $routes->post('delitem', 'camp\Biayalangsung::deletedata');
});
$routes->group('cektiket', ['filter' => 'auth'],  function ($routes) {
    $routes->get('/', 'alat\tiket\Cektiket::index');
    $routes->post('notiket', 'alat\tiket\Cektiket::loadtiket');
    $routes->post('datatiket', 'alat\tiket\Cektiket::outfocustiket');
    $routes->post('save', 'alat\tiket\Cektiket::savedata');

    // $routes->get('camp', 'extra\Loadfile::modalcamp');

    // $routes->get('input', 'camp\tiket\Cektiket::showdata');
    // $routes->post('loadproyek', 'file\aset\Ruas::loadproyek');
    // $routes->post('gantidokumen', 'camp\tiket\Cektiket::outfocusdokumen');
    // $routes->get('tabtiket', 'extra\Loadtran::tabeltiket');
    // $routes->post('loadproyek', 'extra\Loadfile::loadproyek');
});

$routes->group('tsproyek', ['filter' => 'auth'],  function ($routes) {
    $routes->get('/', 'alat\tiket\Tsproyek::index');
    // $routes->post('addtiket', 'alat\tiket\Tsproyek::tambahdata');
    // $routes->get('camp', 'extra\Loadfile::modalcamp');
    $routes->post('docsewa', 'alat\tiket\Tsproyek::loadsosewa');
    // $routes->post('gantidocjual', 'alat\tiket\Tsproyek::outfocusdocjual');
    // $routes->post('gantiruas', 'alat\tiket\Tsproyek::outfocusruas');
    // $routes->post('gantidocsewa', 'alat\tiket\Tsproyek::outfocusdocsewa');
    // $routes->post('gantibahan', 'alat\tiket\Tsproyek::outfocusbahan');
    // $routes->post('alat', 'alat\tiket\Tsproyek::loadalat');
    // $routes->post('gantialat', 'alat\tiket\Tsproyek::outfocusalat');
    // $routes->post('supir', 'extra\Loadfile::loadpenerima');
    // $routes->post('gantisupir', 'alat\tiket\Tsproyek::outfocussupir');
    // $routes->get('tabtiket', 'extra\Loadtran::tabeltiket');

    // $routes->get('beban', 'Komponen::modalbeban');
    // $routes->post('biaya', 'Komponen::loadbiaya');
    // $routes->get('tabitembiaya', 'Komponen::tabelbudgetanak');
    // $routes->get('editkas', 'camp\Biayalangsung::modalkoreksikas');
    // $routes->post('delitem', 'camp\Biayalangsung::deletedata');
});
// CAMP____________________________________________________________________________________________________________________________
$routes->group('jualbahan', ['filter' => 'auth'],  function ($routes) {
    $routes->get('/', 'camp\order\Jualbahan::index');
    $routes->get('input', 'camp\order\Jualbahan::crany');
    $routes->get('input/(:any)', 'camp\order\Jualbahan::showdata/$1');
    $routes->post('addjual', 'camp\order\Jualbahan::tambahdata');
    // $routes->post('savedoc', 'kas\Kaslangsung::savedokumen');
    // $routes->get('bataldoc/(:any)', 'kas\Kaslangsung::canceldokumen/$1');
    $routes->get('tabsales', 'extra\Loadtran::tabelsalesinduk');
    $routes->get('camp', 'extra\Loadfile::modalcamp');
    $routes->get('proyek', 'extra\Loadfile::modalproyek');
    $routes->post('penerima1', 'extra\Loadfile::loadpenerima1');
    $routes->post('pelanggan', 'extra\Loadfile::loadpenerima');
    $routes->post('item', 'extra\Loadfile::loadbarang');
    $routes->post('satuan', 'camp\order\Jualbahan::loadsatuan');
    $routes->post('loadcamp', 'camp\order\Jualbahan::loadcamp');
    $routes->get('tabsalesitem', 'extra\Loadtran::tabelsalesanak');

    // $routes->post('biaya', 'Komponen::loadbiaya');
    // $routes->get('editkas', 'camp\Biayalangsung::modalkoreksikas');
    // $routes->post('delitem', 'camp\Biayalangsung::deletedata');
});

// Transaksi Kas____________________________________________________________________________________________________________________________
$routes->group('kaslangsung', ['filter' => 'auth'],  function ($routes) {
    $routes->get('/', 'trkas\pengeluaran\Kaslangsung::index');
    $routes->get('input', 'trkas\pengeluaran\Kaslangsung::crany');
    $routes->get('input/(:any)', 'trkas\pengeluaran\Kaslangsung::showdata/$1');
    $routes->post('peminta', 'extra\Loadfile::loaduser');

    $routes->post('additem', 'trkas\pengeluaran\Kaslangsung::tambahdata');
    // $routes->post('edititem', 'trkas\pengeluaran\Kaslangsung::updatedata');
    // $routes->post('delitem', 'trkas\pengeluaran\Kaslangsung::deletedata');

    // $routes->post('savedoc', 'kas\Kaslangsung::savedokumen');
    // $routes->get('bataldoc/(:any)', 'kas\Kaslangsung::canceldokumen/$1');
    // $routes->get('tabminta', 'Komponen::tabelmintakas');
    // $routes->get('user', 'Komponen::modaluser');
    $routes->get('tabminta', 'extra\Loadtran::tabelmintakas');

    $routes->get('beban', 'extra\Loadfile::modalbeban');
    $routes->post('penerima', 'extra\Loadfile::loadpenerima');
    $routes->post('ruas', 'extra\Loadfile::loadruas');
    $routes->post('anggaran', 'extra\Loadtran::loadanggaran');
    // $routes->post('biaya', 'extra\Loadfile::loadbiaya');

    // $routes->post('akun', 'extra\Loadfile::loadakun');

    // $routes->post('ruas', 'Komponen::loadruas');
    // $routes->post('biaya', 'Komponen::loadbiaya');
    $routes->post('sumberdaya', 'extra\loadfile::loadbiaya');
    // $routes->post('akun', 'Komponen::loadakun');

    $routes->get('tabkas', 'extra\loadtran::tabeldatakas');
    // $routes->get('editkas', 'kas\Kaslangsung::modalkoreksikas');
    // $routes->post('delkas', 'kas\Kaslangsung::deletedata');
    // $routes->get('tabbiaya', 'extra\Loadtran::tabelbiayaanggaran');
});

// $routes->group('kasum', ['filter' => 'auth'],  function ($routes) {
//     $routes->get('/', 'kas\Kasum::index');
//     $routes->get('input', 'kas\Kasum::crany');
//     $routes->get('input/(:any)', 'kas\Kasum::showdata/$1');
//     $routes->post('save', 'kas\Kasum::savedata');
//     $routes->get('tabminta', 'Komponen::tabelmintakas');
//     $routes->get('user', 'Komponen::modaluser');
//     $routes->get('beban', 'Komponen::modalbeban');
//     $routes->post('penerima', 'Komponen::loadpenerima');
//     $routes->post('akun', 'kas\Kasum::loadakun');
//     $routes->post('supir', 'Komponen::loadpegawai');
//     $routes->post('barang', 'Komponen::loadbarang');
//     $routes->get('tabkas', 'Komponen::tabelkas');
//     $routes->post('delkas', 'kas\Kasum::deletekas');
// });
// $routes->group('kaspindah', ['filter' => 'auth'],  function ($routes) {
//     $routes->get('/', 'kas\Kaspindah::index');
//     $routes->get('input', 'kas\Kaspindah::crany');
//     $routes->get('input/(:any)', 'kas\Kaspindah::showdata/$1');
//     $routes->post('save', 'kas\Kaspindah::savedata');
//     $routes->get('bataldoc/(:any)', 'kas\Kaspindah::canceldokumen/$1');
//     $routes->get('tabminta', 'Komponen::tabelmintakas');
//     $routes->get('user', 'Komponen::modaluser');
//     $routes->get('beban', 'Komponen::modalbeban');
//     $routes->post('penerima', 'Komponen::loadpenerima');
//     $routes->post('akun', 'Komponen::loadakun');
//     $routes->get('tabkas', 'Komponen::tabelkas');
//     $routes->get('addlampir', 'kas\Kaspindah::modallampiran');
//     $routes->post('savelampir', 'kas\Kaspindah::savelampiran');
//     $routes->post('dellampir', 'kas\Kaspindah::deletelampiran');
// });
// $routes->group('kasnonlangsung', ['filter' => 'auth'],  function ($routes) {
//     $routes->get('/', 'kas\Kasnonlangsung::index');
//     $routes->get('input', 'kas\Kasnonlangsung::crany');
//     $routes->get('input/(:any)', 'kas\Kasnonlangsung::showdata/$1');
//     $routes->post('save', 'kas\Kasnonlangsung::savedata');
//     $routes->post('updatedoc', 'kas\Kasnonlangsung::updatedokumen');
//     $routes->get('bataldoc/(:any)', 'kas\Kasnonlangsung::canceldokumen/$1');
//     $routes->get('tabminta', 'Komponen::tabelmintakas');
//     $routes->get('user', 'Komponen::modaluser');
//     $routes->get('beban', 'Komponen::modalbeban');
//     $routes->post('penerima', 'Komponen::loadpenerima');
//     $routes->post('ruas', 'Komponen::loadruas');
//     $routes->post('biaya', 'Komponen::loadbiaya');
//     $routes->post('sumberdaya', 'Komponen::loadbiaya');
//     $routes->post('akun', 'Komponen::loadakun');
//     $routes->post('kbli', 'Komponen::loadkbli');
//     $routes->get('tabkas', 'Komponen::tabelkas');
//     $routes->get('koreksikas', 'kas\Kaslangsung::modalkoreksi');
//     $routes->post('delkas', 'kas\Kaslangsung::deletekas');
//     $routes->get('tabuangmuka', 'kas\Kasnonlangsung::tabeluangmuka');
//     $routes->get('adduangmuka', 'kas\Kasnonlangsung::modaluangmuka');
//     $routes->post('saveuangmuka', 'kas\Kasnonlangsung::saveuangmuka');
// });
$routes->group('cekkas', ['filter' => 'auth'],  function ($routes) {
    $routes->get('/', 'trkas\pengeluaran\Cekkas::index');
    $routes->get('input/(:any)', 'trkas\pengeluaran\Cekkas::showdata/$1');
    $routes->post('pajakitem', 'trkas\pengeluaran\Cekkas::pajakdata');
    $routes->get('tabminta', 'extra\Loadtran::tabelmintakas');
    $routes->get('tabkas', 'extra\loadtran::tabeldatakas');
    $routes->get('logaksi', 'extra\Loadtran::tabellogaksi');
    $routes->post('savedoc', 'trkas\pengeluaran\Cekkas::savedata');
});
$routes->group('keuangan', ['filter' => 'auth'],  function ($routes) {
    $routes->get('/', 'trkas\pengeluaran\Keuangan::index');
    $routes->get('input/(:any)', 'trkas\pengeluaran\Keuangan::showdata/$1');
    $routes->post('pajakitem', 'trkas\pengeluaran\Keuangan::pajakdata');
    $routes->get('tabminta', 'extra\Loadtran::tabelmintakas');
    $routes->get('modaltambah', 'trkas\pengeluaran\Keuangan::modaltambah');
    $routes->get('tabkas', 'extra\loadtran::tabeldatakas');
    $routes->get('logaksi', 'extra\Loadtran::tabellogaksi');
    $routes->post('savedoc', 'trkas\pengeluaran\Keuangan::savedata');
});
$routes->group('potongpajak', ['filter' => 'auth'],  function ($routes) {
    $routes->get('/', 'trkas\pengeluaran\Potongpajak::index');
    $routes->get('input/(:any)', 'trkas\pengeluaran\Potongpajak::showdata/$1');
    $routes->get('tabminta', 'extra\Loadtran::tabelmintakas');
    $routes->get('tabkas', 'extra\loadtran::tabeldatakas');
    $routes->get('logaksi', 'extra\Loadtran::tabellogaksi');
    $routes->post('savedoc', 'trkas\pengeluaran\Potongpajak::savedata');
});
$routes->group('kasir', ['filter' => 'auth'],  function ($routes) {
    $routes->get('/', 'trkas\pengeluaran\Kasir::index');
    $routes->get('input/(:any)', 'trkas\pengeluaran\Kasir::showdata/$1');
    // $routes->post('pajakitem', 'trkas\pengeluaran\Cekkas::pajakdata');
    $routes->get('tabminta', 'extra\Loadtran::tabelmintakas');
    $routes->get('tabkas', 'extra\loadtran::tabeldatakas');
    // $routes->get('logaksi', 'extra\Loadtran::tabellogaksi');
    // $routes->post('savedoc', 'trkas\pengeluaran\Cekkas::savedata');
});
// $routes->group('kasir', ['filter' => 'auth'],  function ($routes) {
//     $routes->get('/', 'kas\Kasir::index');
//     $routes->get('tabminta', 'Komponen::tabelmintakas');
//     $routes->get('input/(:any)', 'kas\Kasir::showdata/$1');
//     $routes->get('tabkas', 'Komponen::tabeldatakas');
//     $routes->post('savedoc/(:any)', 'kas\Kasir::savedokumen/$1');
// });

// HRD____________________________________________________________________________________________________________________________


// $routes->group('itmk', ['filter' => 'auth'],  function ($routes) {
//     $routes->get('/', 'hrd\Itmk::index');
//     $routes->get('input', 'hrd\Itmk::crany');
//     $routes->get('input/(:any)', 'hrd\Itmk::showdata/$1');
//     $routes->post('save/(:any)', 'hrd\Itmk::savedata/$1');
//     $routes->post('pegawai', 'Komponen::loadpegawai');
//     $routes->post('detilpegawai', 'hrd\Itmk::loadpegawai');
//     $routes->get('tabminta', 'Komponen::tabelmintacuti');
// });
// $routes->group('cekitmk', ['filter' => 'auth'],  function ($routes) {
//     $routes->get('/', 'hrd\Cekitmk::index');
//     $routes->get('input/(:any)', 'hrd\Cekitmk::showdata/$1');
//     $routes->post('save/(:any)', 'hrd\Cekitmk::savedata/$1');
//     $routes->get('tabminta', 'Komponen::tabelmintacuti');
//     $routes->get('logaksi', 'Komponen::tabellogaksi');
// });
// $routes->group('nilaipegawai', ['filter' => 'auth'],  function ($routes) {
//     $routes->get('/', 'hrd\Nilaipegawai::index');
//     $routes->get('input', 'hrd\Nilaipegawai::crany');
//     $routes->get('input/(:any)', 'hrd\Nilaipegawai::showdata/$1');
//     // $routes->post('save/(:any)', 'hrd\Nilaipegawai::savedata/$1');
//     $routes->post('pegawai', 'Komponen::loadpegawai');
//     $routes->post('detilpegawai', 'hrd\Itmk::loadpegawai');
//     $routes->get('tabminta', 'Komponen::tabelnilaipegawai');
// });
/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
