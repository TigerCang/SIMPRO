<nav class="pcoded-navbar">
    <div class="pcoded-inner-navbar main-menu">
        <!-- Menu file -->
        <div class="pcoded-navigatio-lavel"><?= lang('app.berkas') ?></div>
        <ul class="pcoded-item pcoded-left-item">
            <!-- Menu admin -->
            <li class="pcoded-hasmenu" <?= ((preg_match("/A01/i", $tmenu['menu_1'])) ? '' : 'hiddena') ?>>
                <a href="javascript:void(0)"><span class="pcoded-micon"><i class="fa fa-user-secret"></i></span><span class="pcoded-mtext"><?= lang('app.admin') ?></span></a>
                <ul class="pcoded-submenu">
                    <li <?= ((preg_match("/101/i", $tmenu['menu_1'])) ? '' : 'hiddena') ?>><a href="index-1.htm"><span class="pcoded-mtext"><?= lang('app.db') ?></span></a></li>
                    <li <?= ((preg_match("/102/i", $tmenu['menu_1'])) ? '' : 'hiddena') ?>><a href="/konfigurasi"><span class="pcoded-mtext"><?= lang('app.config') ?></span></a></li>
                    <li <?= ((preg_match("/103/i", $tmenu['menu_1'])) ? '' : 'hiddena') ?>><a href="/role"><span class="pcoded-mtext"><?= lang('app.role') ?></span></a></li>
                    <li <?= ((preg_match("/104/i", $tmenu['menu_1'])) ? '' : 'hiddena') ?>><a href="/user"><span class="pcoded-mtext"><?= lang('app.user') ?></span></a></li>
                    <li <?= ((preg_match("/105/i", $tmenu['menu_1'])) ? '' : 'hiddena') ?>><a href="/loguser"><span class="pcoded-mtext"><?= lang('app.loguser') ?></span></a></li>
                    <li <?= ((preg_match("/106/i", $tmenu['menu_1'])) ? '' : 'hiddena') ?>><a href="/ulangsandi"><span class="pcoded-mtext"><?= lang('app.resetpass') ?></span></a></li>
                </ul>
            </li>
            <!-- Menu Deklarasi -->
            <li class="pcoded-hasmenu" <?= ((preg_match("/A02/i", $tmenu['menu_1'])) ? '' : 'hiddena') ?>>
                <a href="javascript:void(0)"><span class="pcoded-micon"><i class="fa fa-map-signs"></i></span><span class="pcoded-mtext"><?= lang('app.deklar') ?></span></a>
                <ul class="pcoded-submenu">
                    <li <?= ((preg_match("/107/i", $tmenu['menu_1'])) ? '' : 'hiddena') ?>><a href="/perusahaan"><span class="pcoded-mtext"><?= lang('app.perusahaan') ?></span></a></li>
                    <li <?= ((preg_match("/108/i", $tmenu['menu_1'])) ? '' : 'hiddena') ?>><a href="/wilayah"><span class="pcoded-mtext"><?= lang('app.wilayah') ?></span></a></li>
                    <li <?= ((preg_match("/109/i", $tmenu['menu_1'])) ? '' : 'hiddena') ?>><a href="/divisi"><span class="pcoded-mtext"><?= lang('app.divisi') ?></span></a></li>
                    <li <?= ((preg_match("/140/i", $tmenu['menu_1'])) ? '' : 'hiddena') ?>><a href="/auser"><span class="pcoded-mtext"><?= lang('app.user') ?></span></a></li>
                    <li><a href=""><?= lang('app.spgaris') ?></a></li>
                    <li <?= ((preg_match("/110/i", $tmenu['menu_1'])) ? '' : 'hiddena') ?>><a href="/satuan"><span class="pcoded-mtext"><?= lang('app.satuan') ?></span><span class="pcoded-badge label label-warning">100+</span></a></li>
                    <li <?= ((preg_match("/111/i", $tmenu['menu_1'])) ? '' : 'hiddena') ?>><a href="/gudang"><span class="pcoded-mtext"><?= lang('app.gudang') ?></span></a></li>
                    <li <?= ((preg_match("/112/i", $tmenu['menu_1'])) ? '' : 'hiddena') ?>><a href="/nodokumen"><span class="pcoded-mtext"><?= lang('app.nodokumen') ?></span></a></li>
                    <li <?= ((preg_match("/113/i", $tmenu['menu_1'])) ? '' : 'hiddena') ?>><a href="/noform"><span class="pcoded-mtext"><?= lang('app.noform') ?></span></a></li>
                    <li <?= ((preg_match("/114/i", $tmenu['menu_1'])) ? '' : 'hiddena') ?>><a href="/propinsi"><span class="pcoded-mtext"><?= lang('app.propkabu') ?></span></a></li>
                    <li><a href=""><?= lang('app.spgaris') ?></a></li>
                    <li class="pcoded-hasmenu" <?= ((preg_match("/A03/i", $tmenu['menu_1'])) ? '' : 'hiddena') ?>><a href="javascript:void(0)"><span class="pcoded-mtext"><?= lang('app.biayaproyek') ?></span></a>
                        <ul class="pcoded-submenu">
                            <li <?= ((preg_match("/115/i", $tmenu['menu_1'])) ? '' : 'hiddena') ?>><a href="/katproyek"><span class="pcoded-mtext"><?= lang('app.katproyek') ?></span></a></li>
                            <li <?= ((preg_match("/116/i", $tmenu['menu_1'])) ? '' : 'hiddena') ?>><a href="/biayal"><span class="pcoded-mtext"><?= lang('app.biayal') ?></span></a></li>
                            <li <?= ((preg_match("/117/i", $tmenu['menu_1'])) ? '' : 'hiddena') ?>><a href="/biayatl"><span class="pcoded-mtext"><?= lang('app.biayatl') ?></span></a></li>
                            <li <?= ((preg_match("/118/i", $tmenu['menu_1'])) ? '' : 'hiddena') ?>><a href="/biayasd"><span class="pcoded-mtext"><?= lang('app.sumberdaya') ?></span></a></li>
                        </ul>
                    </li>
                    <li class="pcoded-hasmenu" <?= ((preg_match("/A04/i", $tmenu['menu_1'])) ? '' : 'hiddena') ?>><a href="javascript:void(0)"><span class="pcoded-mtext"><?= lang('app.jarak') ?></span></a>
                        <ul class="pcoded-submenu">
                            <li <?= ((preg_match("/119/i", $tmenu['menu_1'])) ? '' : 'hiddena') ?>><a href="/subruas"><span class="pcoded-mtext"><?= lang('app.subruas') ?></span></a></li>
                            <li <?= ((preg_match("/120/i", $tmenu['menu_1'])) ? '' : 'hiddena') ?>><a href="/lokasi"><span class="pcoded-mtext"><?= lang('app.lokasi') ?></span></a></li>
                        </ul>
                    </li>
                    <li class="pcoded-hasmenu" <?= ((preg_match("/A05/i", $tmenu['menu_1'])) ? '' : 'hiddena') ?>><a href="javascript:void(0)"><span class="pcoded-mtext"><?= lang('app.param') ?></span></a>
                        <ul class="pcoded-submenu">
                            <li <?= ((preg_match("/121/i", $tmenu['menu_1'])) ? '' : 'hiddena') ?>><a href="/tarif"><span class="pcoded-mtext"><?= lang('app.tarif') ?></span></a></li>
                        </ul>
                    </li>
                    <li><a href=""><?= lang('app.spgaris') ?></a></li>
                    <li <?= ((preg_match("/153/i", $tmenu['menu_1'])) ? '' : 'hiddena') ?>><a href="/anggaran"><span class="pcoded-mtext"><?= lang('app.anggaranbawaan') ?></span></a></li>
                </ul>
            </li>
            <!-- Menu Branch -->
            <li class="pcoded-hasmenu" <?= ((preg_match("/A06/i", $tmenu['menu_1'])) ? '' : 'hiddena') ?>>
                <a href="javascript:void(0)"><span class="pcoded-micon"><i class="fa fa-sitemap"></i></span><span class="pcoded-mtext"><?= lang('app.cabangaset') ?></span></a>
                <ul class="pcoded-submenu">
                    <li <?= ((preg_match("/122/i", $tmenu['menu_1'])) ? '' : 'hiddena') ?>><a href="/camp"><span class="pcoded-mtext"><?= lang('app.camp') ?></span></a></li>
                    <li class="pcoded-hasmenu" <?= ((preg_match("/A07/i", $tmenu['menu_1'])) ? '' : 'hiddena') ?>>
                        <a href="javascript:void(0)"><span class="pcoded-mtext"><?= lang('app.proyek') ?></span></a>
                        <ul class="pcoded-submenu">
                            <li <?= ((preg_match("/123/i", $tmenu['menu_1'])) ? '' : 'hiddena') ?>><a href="/proyek"><span class="pcoded-mtext"><?= lang('app.proyek') ?></span></a></li>
                            <li <?= ((preg_match("/124/i", $tmenu['menu_1'])) ? '' : 'hiddena') ?>><a href="/ruas"><span class="pcoded-mtext"><?= lang('app.ruas') ?></span></a></li>
                        </ul>
                    </li>
                    <li><a href=""><?= lang('app.spgaris') ?></a></li>
                    <li class="pcoded-hasmenu" <?= ((preg_match("/A08/i", $tmenu['menu_1'])) ? '' : 'hiddena') ?>>
                        <a href="javascript:void(0)"><span class="pcoded-mtext"><?= lang('app.alat') ?></span></a>
                        <ul class="pcoded-submenu">
                            <li <?= ((preg_match("/125/i", $tmenu['menu_1'])) ? '' : 'hiddena') ?>><a href="/katalat"><span class="pcoded-mtext"><?= lang('app.katalat') ?></span></a></li>
                            <li <?= ((preg_match("/126/i", $tmenu['menu_1'])) ? '' : 'hiddena') ?>><a href="/alat"><span class="pcoded-mtext"><?= lang('app.alat') ?></span></a></li>
                        </ul>
                    </li>
                    <li <?= ((preg_match("/127/i", $tmenu['menu_1'])) ? '' : 'hiddena') ?>><a href="/tanah"><span class="pcoded-mtext"><?= lang('app.tanah') ?></span></a></li>
                    <li><a href=""><?= lang('app.spgaris') ?></a></li>
                    <li <?= ((preg_match("/154/i", $tmenu['menu_1'])) ? '' : 'hiddena') ?>><a href="/tool"><span class="pcoded-mtext"><?= lang('app.tool') ?></span></a></li>
                    <li <?= ((preg_match("/128/i", $tmenu['menu_1'])) ? '' : 'hiddena') ?>><a href="/inventaris"><span class="pcoded-mtext"><?= lang('app.inventaris') ?></span></a></li>
                </ul>
            </li>
            <!-- Menu Akuntansi -->
            <li class="pcoded-hasmenu" <?= ((preg_match("/A09/i", $tmenu['menu_1'])) ? '' : 'hiddena') ?>>
                <a href="javascript:void(0)"><span class="pcoded-micon"><i class="fa fa-balance-scale"></i></span><span class="pcoded-mtext"><?= lang('app.akuntansi') ?></span></a>
                <ul class="pcoded-submenu">
                    <li <?= ((preg_match("/129/i", $tmenu['menu_1'])) ? '' : 'hiddena') ?>><a href="/akuntansi"><span class="pcoded-mtext"><?= lang('app.coa') ?></span></a></li>
                    <li <?= ((preg_match("/130/i", $tmenu['menu_1'])) ? '' : 'hiddena') ?>><a href="/akungrup"><span class="pcoded-mtext"><?= lang('app.akungrup') ?></span></a></li>
                    <li <?= ((preg_match("/131/i", $tmenu['menu_1'])) ? '' : 'hiddena') ?>><a href="/defakun"><span class="pcoded-mtext"><?= lang('app.akunbawaan') ?></span></a></li>
                    <li <?= ((preg_match("/132/i", $tmenu['menu_1'])) ? '' : 'hiddena') ?>><a href="/akunkas"><span class="pcoded-mtext"><?= lang('app.kasbank') ?></span></a></li>
                    <li <?= ((preg_match("/133/i", $tmenu['menu_1'])) ? '' : 'hiddena') ?>><a href="/akunpajak"><span class="pcoded-mtext"><?= lang('app.pajak') ?></span></a></li>
                    <li><a href=""><?= lang('app.spgaris') ?></a></li>
                    <li <?= ((preg_match("/134/i", $tmenu['menu_1'])) ? '' : 'hiddena') ?>><a href="/dokumenpajak"><span class="pcoded-mtext"><?= lang('app.dokumenpajak') ?></span></a></li>
                </ul>
            </li>
            <!-- Menu Item -->
            <li class="pcoded-hasmenu" <?= (preg_match("/A10/i", $tmenu['menu_1'])) ? '' : 'hiddena' ?>>
                <a href="javascript:void(0)"><span class="pcoded-micon"><i class="fa fa-cubes"></i></span><span class="pcoded-mtext"><?= lang('app.item') ?></span></a>
                <ul class="pcoded-submenu">
                    <li <?= ((preg_match("/135/i", $tmenu['menu_1'])) ? '' : 'hiddena') ?>><a href="/barang"><span class="pcoded-mtext"><?= lang('app.sparepart') ?></span></a></li>
                    <li <?= ((preg_match("/137/i", $tmenu['menu_1'])) ? '' : 'hiddena') ?>><a href="/bahan"><span class="pcoded-mtext"><?= lang('app.bahan') ?></span></a></li>
                    <li <?= ((preg_match("/138/i", $tmenu['menu_1'])) ? '' : 'hiddena') ?>><a href="/bekas"><span class="pcoded-mtext"><?= lang('app.bekas') ?></span></a></li>
                    <li <?= ((preg_match("/139/i", $tmenu['menu_1'])) ? '' : 'hiddena') ?>><a href="/nonstok"><span class="pcoded-mtext"><?= lang('app.nonstok') ?></span></a></li>
                    <li><a href=""><?= lang('app.spgaris') ?></a></li>
                    <li <?= ((preg_match("/136/i", $tmenu['menu_1'])) ? '' : 'hiddena') ?>><a href="/noseri"><span class="pcoded-mtext"><?= lang('app.sn') ?></span></a></li>
                </ul>
            </li>
            <!-- Menu Penerima -->
            <li class="pcoded-hasmenu" <?= ((preg_match("/A11/i", $tmenu['menu_1'])) ? '' : 'hiddena') ?>>
                <a href="javascript:void(0)"><span class="pcoded-micon"><i class="icofont icofont-people"></i></span><span class="pcoded-mtext"><?= lang('app.penerima') ?></span></a>
                <ul class="pcoded-submenu">
                    <li <?= ((preg_match("/141/i", $tmenu['menu_1'])) ? '' : 'hiddena') ?>><a href="/penerima"><span class="pcoded-mtext"><?= lang('app.penerima') ?></span></a></li>
                    <li <?= ((preg_match("/142/i", $tmenu['menu_1'])) ? '' : 'hiddena') ?>><a href="/tautp"><span class="pcoded-mtext"><?= lang('app.tautperusahaan') ?></span></a></li>
                    <li><a href=""><?= lang('app.spgaris') ?></a></li>
                    <li <?= ((preg_match("/143/i", $tmenu['menu_1'])) ? '' : 'hiddena') ?>><a href="/rekanalat"><span class="pcoded-mtext"><?= lang('app.mobilrekan') ?></span></a></li>
                </ul>
            </li>
            <!-- Menu Sumber Daya Manusia -->
            <li class="pcoded-hasmenu" <?= (preg_match("/A12/i", $tmenu['menu_1'])) ? '' : 'hiddena' ?>>
                <a href="javascript:void(0)"><span class="pcoded-micon"><i class="icofont icofont-support"></i></span><span class="pcoded-mtext"><?= lang('app.sdm') ?></span></a>
                <ul class="pcoded-submenu">
                    <li <?= ((preg_match("/144/i", $tmenu['menu_1'])) ? '' : 'hiddena') ?>><a href="/jabatan"><span class="pcoded-mtext"><?= lang('app.jabatan') ?></span></a></li>
                    <li <?= ((preg_match("/145/i", $tmenu['menu_1'])) ? '' : 'hiddena') ?>><a href="/golongan"><span class="pcoded-mtext"><?= lang('app.golongan') ?></span></a></li>
                    <li <?= ((preg_match("/146/i", $tmenu['menu_1'])) ? '' : 'hiddena') ?>><a href="/cuti"><span class="pcoded-mtext"><?= lang('app.cuti') ?></span></a></li>
                    <li <?= ((preg_match("/147/i", $tmenu['menu_1'])) ? '' : 'hiddena') ?>><a href="/katrating"><span class="pcoded-mtext"><?= lang('app.katrating') ?></span></a></li>
                    <li><a href=""><?= lang('app.spgaris') ?></a></li>
                    <li <?= ((preg_match("/148/i", $tmenu['menu_1'])) ? '' : 'hiddena') ?>><a href="/kalender"><span class="pcoded-mtext"><?= lang('app.kalender') ?></span></a></li>
                    <li <?= ((preg_match("/149/i", $tmenu['menu_1'])) ? '' : 'hiddena') ?>><a href="/pengumuman"><span class="pcoded-mtext"><?= lang('app.pengumuman') ?></span></a></li>
                    <li><a href=""><?= lang('app.spgaris') ?></a></li>
                    <li <?= ((preg_match("/150/i", $tmenu['menu_1'])) ? '' : 'hiddena') ?>><a href="/pegawai"><span class="pcoded-mtext"><?= lang('app.pegawai') ?></span></a></li>
                    <li class="pcoded-hasmenu" <?= ((preg_match("/A13/i", $tmenu['menu_1'])) ? '' : 'hiddena') ?>>
                        <a href="javascript:void(0)"><span class="pcoded-mtext"><?= lang('app.gaji') ?></span></a>
                        <ul class="pcoded-submenu">
                            <li <?= ((preg_match("/151/i", $tmenu['menu_1'])) ? '' : 'hiddena') ?>><a href="/atributgaji"><span class="pcoded-mtext"><?= lang('app.atribut') ?></span></a></li>
                            <li <?= ((preg_match("/152/i", $tmenu['menu_1'])) ? '' : 'hiddena') ?>><a href="/gaji"><span class="pcoded-mtext"><?= lang('app.gaji') ?></span></a></li>
                        </ul>
                    </li>
                </ul>
            </li>
        </ul><!-- Akhir ul file -->

        <!-- Menu transaski umum -->
        <div class="pcoded-navigatio-lavel"><?= lang('app.trumum') ?></div>
        <ul class="pcoded-item pcoded-left-item">
            <!-- Menu anggaran -->
            <li class="pcoded-hasmenu">
                <a href="javascript:void(0)"><span class="pcoded-micon"><i class="fa fa-book"></i></span><span class="pcoded-mtext"><?= lang('app.anggaran') ?></span></a>
                <ul class="pcoded-submenu">
                    <li <?= ((preg_match("/101/i", $tmenu['menu_1'])) ? '' : 'hiddena') ?>><a href="/anggbiayal"><span class="pcoded-mtext"><?= lang('app.biayal') ?></span></a></li>
                    <li <?= ((preg_match("/101/i", $tmenu['menu_1'])) ? '' : 'hiddena') ?>><a href="/anggobjek"><span class="pcoded-mtext"><?= lang('app.tujuan') ?></span></a></li>
                    <li <?= ((preg_match("/101/i", $tmenu['menu_1'])) ? '' : 'hiddena') ?>><a href="/anggbiayasd"><span class="pcoded-mtext"><?= lang('app.hargadetil') ?></span></a></li>
                    <li class="pcoded-hasmenu" <?= ((preg_match("/A13/i", $tmenu['menu_1'])) ? '' : 'hiddena') ?>>
                        <a href="javascript:void(0)"><span class="pcoded-mtext"><?= lang('app.revisi') ?></span></a>
                        <ul class="pcoded-submenu">
                            <li <?= ((preg_match("/101/i", $tmenu['menu_1'])) ? '' : 'hiddena') ?>><a href="/revisicabang"><span class="pcoded-mtext"><?= lang('app.cabang') ?></span></a></li>
                            <li <?= ((preg_match("/101/i", $tmenu['menu_1'])) ? '' : 'hiddena') ?>><a href="/revisibiayal"><span class="pcoded-mtext"><?= lang('app.biayal') ?></span></a></li>
                            <li <?= ((preg_match("/101/i", $tmenu['menu_1'])) ? '' : 'hiddena') ?>><a href="/revisibiayatl"><span class="pcoded-mtext"><?= lang('app.biayatl') ?></span></a></li>
                            <li <?= ((preg_match("/101/i", $tmenu['menu_1'])) ? '' : 'hiddena') ?>><a href="/anggbiayasd"><span class="pcoded-mtext"><?= lang('app.hargadetil') ?></span></a></li>
                        </ul>
                    </li>
                    <li><a href=""><?= lang('app.spgaris') ?></a></li>
                    <li <?= (preg_match("/101/i", $tmenu['menu_1'])) ? '' : 'hiddena' ?>><a href="/accbudget"><span class="pcoded-mtext"><?= lang('app.tandat') ?></span></a></li>
                </ul>
            </li>
        </ul><!-- Akhir ul transaksi umum -->

        <!-- Menu transaski item -->
        <div class="pcoded-navigatio-lavel"><?= lang('app.tritem') ?></div>
        <ul class="pcoded-item pcoded-left-item">
            <!-- Menu permintaan barang -->
            <li class="pcoded-hasmenu">
                <a href="javascript:void(0)"><span class="pcoded-micon"><i class="icofont icofont-paper"></i></span><span class="pcoded-mtext"><?= lang('app.mintabarang') ?></span></a>
                <ul class="pcoded-submenu">
                    <li <?= (preg_match("/101/i", $tmenu['menu_1'])) ? '' : 'hiddena' ?>><a href="/mintabarang"><span class="pcoded-mtext"><?= lang('app.mintabarang') ?></span></a></li>
                    <li <?= (preg_match("/101/i", $tmenu['menu_1'])) ? '' : 'hiddena' ?>><a href="/cekada"><span class="pcoded-mtext"><?= lang('app.ceksedia') ?></span></a></li>
                    <li><a href=""><?= lang('app.spgaris') ?></a></li>
                    <li <?= (preg_match("/101/i", $tmenu['menu_1'])) ? '' : 'hiddena' ?>><a href="/cekbarang"><span class="pcoded-mtext"><?= lang('app.tandat') ?></span></a></li>
                </ul>
            </li>
            <!-- Menu pengambilan barang -->
            <li class="pcoded-hasmenu">
                <a href="javascript:void(0)"><span class="pcoded-micon"><i class="icofont icofont-paper"></i></span><span class="pcoded-mtext"><?= lang('app.ambilbarang') ?></span></a>
                <ul class="pcoded-submenu">
                    <li <?= (preg_match("/101/i", $tmenu['menu_1'])) ? '' : 'hiddena' ?>><a href="/ambilbarang"><span class="pcoded-mtext"><?= lang('app.ambilbarang') ?></span></a></li>
                    <li><a href=""><?= lang('app.spgaris') ?></a></li>
                    <li <?= (preg_match("/101/i", $tmenu['menu_1'])) ? '' : 'hiddena' ?>><a href="/cekbarang"><span class="pcoded-mtext"><?= lang('app.tandat') ?></span></a></li>
                </ul>
            </li>
            <!-- Menu pembelian-->
            <li class="pcoded-hasmenu">
                <a href="javascript:void(0)"><span class="pcoded-micon"><i class="fa fa-product-hunt"></i></span><span class="pcoded-mtext"><?= lang('app.pembelian') ?></span></a>
                <ul class="pcoded-submenu">
                    <li <?= (preg_match("/101/i", $tmenu['menu_1'])) ? '' : 'hiddena' ?>><a href="/tawarharga"><span class="pcoded-mtext"><?= lang('app.tawarharga') ?></span></a></li>
                    <li <?= (preg_match("/101/i", $tmenu['menu_1'])) ? '' : 'hiddena' ?>><a href="/pilihharga"><span class="pcoded-mtext"><?= lang('app.pilihharga') ?></span></a></li>
                    <li <?= (preg_match("/101/i", $tmenu['menu_1'])) ? '' : 'hiddena' ?>><a href="/pesanbarang"><span class="pcoded-mtext"><?= lang('app.pesanbarang') ?></span></a></li>
                    <li <?= (preg_match("/101/i", $tmenu['menu_1'])) ? '' : 'hiddena' ?>><a href="/terimabarang"><span class="pcoded-mtext"><?= lang('app.terimabarang') ?></span></a></li>
                    <li <?= (preg_match("/101/i", $tmenu['menu_1'])) ? '' : 'hiddena' ?>><a href="/pesanbarang"><span class="pcoded-mtext"><?= lang('app.kembalibarang') ?></span></a></li>
                    <li <?= (preg_match("/101/i", $tmenu['menu_1'])) ? '' : 'hiddena' ?>><a href="/pesanbarang"><span class="pcoded-mtext"><?= lang('app.rekaptagihan') ?></span></a></li>
                    <li><a href=""><?= lang('app.spgaris') ?></a></li>
                    <li <?= (preg_match("/101/i", $tmenu['menu_1'])) ? '' : 'hiddena' ?>><a href="/cekpo"><span class="pcoded-mtext"><?= lang('app.tandat') ?></span></a></li>
                </ul>
            </li>
            <!-- Menu penjualan -->
            <li class="pcoded-hasmenu">
                <a href="javascript:void(0)"><span class="pcoded-micon"><i class="icofont icofont-cart-alt"></i></span><span class="pcoded-mtext"><?= lang('app.penjualan') ?></span></a>
                <ul class="pcoded-submenu">
                    <li <?= (preg_match("/101/i", $tmenu['menu_1'])) ? '' : 'hiddena' ?>><a href="/sojual"><span class="pcoded-mtext"><?= lang('app.pesanjual') ?></span></a></li>
                    <li <?= (preg_match("/101/i", $tmenu['menu_1'])) ? '' : 'hiddena' ?>><a href="/sosewa"><span class="pcoded-mtext"><?= lang('app.pesansewa') ?></span></a></li>
                    <li><a href=""><?= lang('app.spgaris') ?></a></li>
                    <li <?= (preg_match("/101/i", $tmenu['menu_1'])) ? '' : 'hiddena' ?>><a href="/cekso"><span class="pcoded-mtext"><?= lang('app.tandat') ?></span></a></li>
                </ul>
            </li><!-- Akhir permintaan -->
        </ul><!-- Akhir ul transaksi umum -->

        <!-- Menu transaski divisi -->
        <div class="pcoded-navigatio-lavel"><?= lang('app.trdivisi') ?></div>
        <ul class="pcoded-item pcoded-left-item">
            <!-- Menu anggaran-->
            <li class="pcoded-hasmenu">
                <a href="javascript:void(0)"><span class="pcoded-micon"><i class="fa fa-book"></i></span><span class="pcoded-mtext"><?= lang('app.anggaran') ?></span></a>
                <ul class="pcoded-submenu">
                    <li <?= (preg_match("/101/i", $tmenu['menu_1'])) ? '' : 'hiddena' ?>><a href="/anggproyekbl"><span class="pcoded-mtext"><?= lang('app.biayal') ?></span></a></li>
                    <li <?= (preg_match("/101/i", $tmenu['menu_1'])) ? '' : 'hiddena' ?>><a href="/anggproyekbtl"><span class="pcoded-mtext"><?= lang('app.biayatl') ?></span></a></li>
                    <li <?= (preg_match("/101/i", $tmenu['menu_1'])) ? '' : 'hiddena' ?>><a href="/revisibiayal"><span class="pcoded-mtext"><?= lang('app.revbiayatl') ?></span></a></li>
                    <li><a href=""><?= lang('app.spgaris') ?></a></li>
                    <li <?= (preg_match("/101/i", $tmenu['menu_1'])) ? '' : 'hiddena' ?>><a href="/accbudget"><span class="pcoded-mtext"><?= lang('app.tandat') ?></span></a></li>
                </ul>
            </li>
        </ul><!-- Akhir ul transaksi proyek -->

        <!-- Menu transaski kas -->
        <div class="pcoded-navigatio-lavel"><?= lang('app.trkas') ?></div>
        <ul class="pcoded-item pcoded-left-item">
            <!-- permintaan pcoded-trigger-->
            <li class="pcoded-hasmenu">
                <a href="javascript:void(0)"><span class="pcoded-micon"><i class="fa fa-money"></i></span><span class="pcoded-mtext"><?= lang('app.mintakas') ?></span></a>
                <ul class="pcoded-submenu">
                    <li <?= (preg_match("/101/i", $tmenu['menu_1'])) ? '' : 'hiddena' ?>><a href="/kaslangsung"><span class="pcoded-mtext"><?= lang('app.kaslangsung') ?></span></a></li>
                    <li <?= (preg_match("/101/i", $tmenu['menu_1'])) ? '' : 'hiddena' ?>><a href="/kasum"><span class="pcoded-mtext"><?= lang('app.kasum') ?></span></a></li>
                    <li <?= (preg_match("/101/i", $tmenu['menu_1'])) ? '' : 'hiddena' ?>><a href="/kaspindah"><span class="pcoded-mtext"><?= lang('app.kaspindah') ?></span></a></li>
                    <li <?= (preg_match("/101/i", $tmenu['menu_1'])) ? '' : 'hiddena' ?>><a href="/kasnonlangsung"><span class="pcoded-mtext"><?= lang('app.kasnonlangsung') ?></span></a></li>
                    <li><a href=""><?= lang('app.spgaris') ?></a></li>
                    <li <?= (preg_match("/101/i", $tmenu['menu_1'])) ? '' : 'hiddena' ?>><a href="/cekkas"><span class="pcoded-mtext"><?= lang('app.tandat') ?></span></a></li>
                    <li <?= (preg_match("/101/i", $tmenu['menu_1'])) ? '' : 'hiddena' ?>><a href="/keuangan"><span class="pcoded-mtext"><?= lang('app.keuangan') ?></span></a></li>
                    <li <?= (preg_match("/101/i", $tmenu['menu_1'])) ? '' : 'hiddena' ?>><a href="/potongpajak"><span class="pcoded-mtext"><?= lang('app.potongpajak') ?></span></a></li>
                </ul>
            </li><!-- Akhir pinjaman -->

            <li class=" "><a href="/kasir"><span class="pcoded-micon"><i class="feather icon-aperture rotate-refresh"></i><b>A</b></span><span class="pcoded-mtext"><?= lang('app.kasir') ?></span></a></li>

            <li class="pcoded-hasmenu">
                <a href="javascript:void(0)"><span class="pcoded-micon"><i class="fa fa-money"></i></span><span class="pcoded-mtext"><?= lang('app.pinjam') ?></span></a>
                <ul class="pcoded-submenu">
                    <li <?= (preg_match("/101/i", $tmenu['menu_1'])) ? '' : 'hiddena' ?>><a href="/mintabarang"><span class="pcoded-mtext"><?= lang('app.view') ?></span></a></li>
                    <li <?= (preg_match("/101/i", $tmenu['menu_1'])) ? '' : 'hiddena' ?>><a href="/mintabarang/input"><span class="pcoded-mtext"><?= lang('app.input') ?></span></a></li>
                </ul>
            </li><!-- Akhir pinjaman -->

            <li class="pcoded-hasmenu">
                <a href="javascript:void(0)"><span class="pcoded-micon"><i class="fa fa-money"></i></span><span class="pcoded-mtext"><?= lang('app.kasbon') ?></span></a>
                <ul class="pcoded-submenu">
                    <li <?= (preg_match("/101/i", $tmenu['menu_1'])) ? '' : 'hiddena' ?>><a href="/mintabarang"><span class="pcoded-mtext"><?= lang('app.view') ?></span></a></li>
                    <li <?= (preg_match("/101/i", $tmenu['menu_1'])) ? '' : 'hiddena' ?>><a href="/mintabarang/input"><span class="pcoded-mtext"><?= lang('app.input') ?></span></a></li>
                </ul>
            </li><!-- Akhir kasbon -->
        </ul><!-- Akhir ul mintakas -->

        <!-- Menu transaksi Akuntansi -->
        <div class="pcoded-navigatio-lavel"><?= lang('app.trakuntansi') ?></div>
        <ul class="pcoded-item pcoded-left-item">
            <!-- pendapatan pcoded-trigger-->
            <li class="pcoded-hasmenu"><a href="javascript:void(0)"><span class="pcoded-micon"><i class="fa fa-user-secret"></i></span><span class="pcoded-mtext"><?= lang('app.penjualan') ?></span></a>
                <ul class="pcoded-submenu">
                    <li <?= (preg_match("/101/i", $tmenu['menu_1'])) ? '' : 'hiddena' ?>><a href="/mintabarang"><span class="pcoded-mtext"><?= lang('app.view') ?></span></a></li>
                    <li <?= (preg_match("/101/i", $tmenu['menu_1'])) ? '' : 'hiddena' ?>><a href="/mintabarang/input"><span class="pcoded-mtext"><?= lang('app.input') ?></span></a></li>
                </ul>
            </li><!-- Akhir permintaan -->
        </ul><!-- Akhir ul transaksi akuntansi -->

        <!-- Menu transaksi HRD -->
        <div class="pcoded-navigatio-lavel"><?= lang('app.trhrd') ?></div>
        <ul class="pcoded-item pcoded-left-item">




            <!-- Menu permintaan cuti-->
            <li class="pcoded-hasmenu">
                <a href="javascript:void(0)"><span class="pcoded-micon"><i class="fa fa-user-secret"></i></span><span class="pcoded-mtext"><?= lang('app.cuti') ?></span></a>
                <ul class="pcoded-submenu">
                    <li <?= (preg_match("/101/i", $tmenu['menu_1'])) ? '' : 'hiddena' ?>><a href="/itmk"><span class="pcoded-mtext"><?= lang('app.input') ?></span></a></li>
                    <li><a href=""><?= lang('app.spgaris') ?></a></li>
                    <li <?= (preg_match("/101/i", $tmenu['menu_1'])) ? '' : 'hiddena' ?>><a href="/cekitmk"><span class="pcoded-mtext"><?= lang('app.tandat') ?></span></a></li>
                </ul>
                <a href="javascript:void(0)"><span class="pcoded-micon"><i class="fa fa-user-secret"></i></span><span class="pcoded-mtext"><?= lang('app.penilaian') ?></span></a>
                <ul class="pcoded-submenu">
                    <li <?= (preg_match("/101/i", $tmenu['menu_1'])) ? '' : 'hiddena' ?>><a href="/nilaipegawai"><span class="pcoded-mtext"><?= lang('app.input') ?></span></a></li>
                    <li><a href=""><?= lang('app.spgaris') ?></a></li>
                    <li <?= (preg_match("/101/i", $tmenu['menu_1'])) ? '' : 'hiddena' ?>><a href="/mintabarang/input"><span class="pcoded-mtext"><?= lang('app.tanda') ?></span></a></li>
                </ul>
            </li><!-- Akhir permintaan -->
        </ul><!-- Akhir ul transaksi hrd -->

        <div class="pcoded-navigatio-lavel"><?= lang('app.laporan') ?></div>
        <ul class="pcoded-item pcoded-left-item">

            <!-- laporan pcoded-trigger-->
            <li class="pcoded-hasmenu">
                <a href="javascript:void(0)">
                    <span class="pcoded-micon"><i class="fa fa-user-secret"></i></span>
                    <span class="pcoded-mtext"><?= lang('app.penjualan') ?></span>
                </a>
                <ul class="pcoded-submenu">
                    <li <?= (preg_match("/101/i", $tmenu['menu_1'])) ? '' : 'hiddena' ?>><a href="/mintabarang"><span class="pcoded-mtext"><?= lang('app.view') ?></span></a></li>
                    <li <?= (preg_match("/101/i", $tmenu['menu_1'])) ? '' : 'hiddena' ?>><a href="/mintabarang/input"><span class="pcoded-mtext"><?= lang('app.input') ?></span></a></li>
                </ul>
            </li><!-- Akhir permintaan -->
        </ul><!-- Akhir ul laporan -->

        <div class="pcoded-navigatio-lavel"><?= lang('app.dukungan') ?></div>
        <ul class="pcoded-item pcoded-left-item">

            <!-- dukungan pcoded-trigger-->
            <li class="pcoded-hasmenu">
                <a href="javascript:void(0)"><span class="pcoded-micon"><i class="fa fa-user-secret"></i></span><span class="pcoded-mtext"><?= lang('app.dokumentasi') ?></span></a>
                <ul class="pcoded-submenu">
                    <li <?= (preg_match("/101/i", $tmenu['menu_1'])) ? '' : 'hiddena' ?>><a href="/mintabarang"><span class="pcoded-mtext"><?= lang('app.view') ?></span></a></li>
                    <li <?= (preg_match("/101/i", $tmenu['menu_1'])) ? '' : 'hiddena' ?>><a href="/mintabarang/input"><span class="pcoded-mtext"><?= lang('app.input') ?></span></a></li>
                </ul>
            </li><!-- Akhir permintaan -->
        </ul><!-- Akhir ul dukungan -->
    </div>
</nav>